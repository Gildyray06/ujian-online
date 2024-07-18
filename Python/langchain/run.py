import os
import sys
import requests
import time
from langchain_community.document_loaders import PyPDFLoader
from langchain_community.document_loaders import TextLoader

from operator import itemgetter

from langchain_community.vectorstores import FAISS
from langchain.output_parsers import ResponseSchema
from langchain.output_parsers import StructuredOutputParser
from langchain_core.output_parsers import StrOutputParser
from langchain_core.prompts import ChatPromptTemplate
from langchain.prompts import PromptTemplate
from langchain_core.runnables import RunnableLambda, RunnablePassthrough
from langchain_openai import ChatOpenAI, OpenAIEmbeddings

from langchain_core.output_parsers import JsonOutputParser
from langchain_core.pydantic_v1 import BaseModel, Field
from typing import List, Optional

from langchain.output_parsers import PydanticOutputParser

from flask import Flask, request, jsonify

API_KEY='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'
os.environ["OPENAI_API_KEY"] = API_KEY




app = Flask(__name__)
@app.before_request
def before_request():
    # Set timeout (in seconds) for all requests
    request.timeout = 90

def download_text_file(url, file_path):
    try:
        # Send a GET request to the URL
        response = requests.get(url)
        
        # Raise an exception for HTTP errors
        response.raise_for_status()
        
        # Open the file in write mode and save the response content
        with open(file_path, 'wb') as file:
            file.write(response.content)
        
        return (f"File downloaded and saved to {file_path}")
    except Exception as e:
        return (f"Error: {e}")

class Question(BaseModel):
    question: str = Field(description="This is the question")
    options_of_answer: list = Field(description="This is List always containing 5 answer options only 1 is correct, please randomize the position of the correct answer")
    correct_answer: int = Field(description="This is the correct answer, containing the key from options_of_answer 0-4")
    taxonomy_level: int = Field(description="1 for Pengetahuan, 2 for Pemahaman, 3 for Penerapan, 4 for Analisis, 5 for Evaluasi, 6 for Ciptakan")
    keyword: list = Field(description="Create 5 phrases or short sentences that accurately describe the correct answer to the following essay question. Each phrase should not use words from the question itself. If participants use these 5 phrases in their answer, it will be considered correct.")
    


class QuestionList(BaseModel):
    data: List[Question]


class Answer(BaseModel):
    question_id: str = Field(description="base on question_id")
    evaluation: bool = Field(description="true|false")
    explanation: str = Field(description="Explanation of why the answer is correct or incorrect")

class AnserList(BaseModel):
    data: List[Answer]


@app.route('/generate', methods=['POST'])
def link():
    jumlah = request.json["jumlah"]
    materi = request.json["materi"]
    file_path='text/'+ str(time.time())+'.txt'
    download_text_file(materi, file_path)

    loader = TextLoader(file_path, autodetect_encoding=True)
    pages = loader.load()
    text=""

    for page in pages:
        text+=page.page_content

    vectorstore = FAISS.from_texts(
        [text], embedding=OpenAIEmbeddings()
    )
    retriever = vectorstore.as_retriever()



    parser = PydanticOutputParser(pydantic_object=QuestionList)


    template = """Create {number_of_question} unique and specific questions based only on the following context:
    {context}

    Based on Bloom's Taxonomy levels.
    Pengetahuan
    Pemahaman
    Penerapan
    Analisis
    Evaluasi
    Ciptakan

    Ensure the questions are directly related to the content and require thoughtful responses, not just factual recall. User Indonesia language.

    {format_instructions}
    """
    # prompt = ChatPromptTemplate.from_template(template)


    prompt = PromptTemplate(
        template=template,
        input_variables=["context","number_of_question"],
        partial_variables={"format_instructions": parser.get_format_instructions()},
    )

    model = ChatOpenAI()

    chain = (
        {"context": retriever, "number_of_question": RunnablePassthrough()}
        | prompt
        | model
        | StrOutputParser()
    )

    return (chain.invoke(jumlah))




@app.route('/check', methods=['POST'])
def check():
    soal = request.json["soal"]


    print(soal)

    materi = request.json["materi"]
    file_path='text/'+ str(time.time())+'.txt'
    download_text_file(materi, file_path)

    loader = TextLoader(file_path, autodetect_encoding=True)
    pages = loader.load()
    text=""

    for page in pages:
        text+=page.page_content

    vectorstore = FAISS.from_texts(
        [text], embedding=OpenAIEmbeddings()
    )
    retriever = vectorstore.as_retriever()



    parser = PydanticOutputParser(pydantic_object=AnserList)


    template = """Evaluate whether the following answer is correct or incorrect based on the given context. Provide an explanation for why the answer is correct or incorrect. based only on the following context:
    {context}

    **Question and Anser**
    {soal}

    {format_instructions}
    """
    # prompt = ChatPromptTemplate.from_template(template)


    prompt = PromptTemplate(
        template=template,
        input_variables=["context"],
        partial_variables={ "soal": soal,"format_instructions": parser.get_format_instructions()},
    )

    model = ChatOpenAI()

    # Menyediakan nilai untuk 'context' dan 'soal' saat memanggil chain.invoke()
    chain = (
        {"context": retriever}
        | prompt
        | model
        | StrOutputParser()
    )
    return (chain.invoke('s'))


if __name__ == '__main__':
    # ssl_context = ssl.SSLContext(ssl.PROTOCOL_TLSv1_2)
    # ssl_context.load_cert_chain('/etc/letsencrypt/live/tail.juragancode.id/fullchain.pem', '/etc/letsencrypt/live/tail.juragancode.id/privkey.pem')
    # app.run(ssl_context=ssl_context, host='0.0.0.0', port=443, debug=False)
    app.run(host='0.0.0.0', port=5300, debug=False)


# loader = OnlineTextLoader("pdf/text/1710664617.txt", autodetect_encoding=True)
# pages = loader.load()
# text=""
# print(pages)