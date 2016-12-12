#!/Library/Frameworks/Python.framework/Versions/Current/bin/python
# -*- coding: UTF-8 -*-
import requests
import time,datetime
import random
import MySQLdb
import logging
from bs4 import BeautifulSoup
import re

def getHtml(url):
    try:
        user_agent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36'
        headers = {
            'User-Agent' : user_agent,
            'Referer':'http://www.google.com/'
            }
        html = requests.get(url,headers=headers)
        return html
    except Exception as e:
        logging.info("Meliuz Say No!~")
        return 0
def getSoup(html):
    soup = BeautifulSoup(str(html.content), "html.parser")
    return soup
def getHrefs(soup):
    try:
        hrefs = soup.find_all("a",href=re.compile("/desconto/"),attrs=not {"class": "txt--gray-dark"})
        return hrefs
    except:
        return ''
def googleGetURL(keyword):
    try:
        user_agent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36'
        headers = { 'User-Agent' : user_agent }
        google = 'https://www.google.com.br/search?q='
        html = requests.get(google+keyword,headers=headers)
        soup = BeautifulSoup(str(html.content), "html.parser")
        url = soup.find('cite',"_Rm").get_text()
        return url
    except Exception as e:
        logging.info("Google Say No!~")
        return ''
    
if __name__ == '__main__':
    while 1:
        #Log
        logging.basicConfig(level=logging.DEBUG,
                    format='%(process)d %(asctime)s %(filename)s[line:%(lineno)d] %(levelname)s %(message)s',
                    datefmt='%a, %d %b %Y %H:%M:%S',
                    filename='Colpon-Lojas.log',
                    filemode='w')
        #Start
        logging.info("Today Start %s" % time.strftime("%Y-%m-%d %H:%M:%S"))
        url = 'https://www.meliuz.com.br/desconto'
        html = getHtml(url)
        soup = getSoup(html)
        hrefs = getHrefs(soup)
        #SQLs
        sqlselect = "SELECT * FROM stores"
        sqlupdate = "UPDATE stores set link = %s,url = %s,updated_at = %s  where id = %s"
        sqlinsert = "INSERT INTO stores (initials,name,description,link,url,titleslug,created_at,updated_at) values (%s,%s,%s,%s,%s,%s,%s,%s)"
        for href in hrefs:
            #Open SQL
            conn = MySQLdb.connect(
                host = 'localhost',
                port = 3306,
                user = 'root',
                passwd = 'root',
                db = 'colpon',
                charset = 'utf8',
                )
            cursor = conn.cursor()
            #Select Stores
            cursor.execute(sqlselect)
            stores = cursor.fetchall()
            name = href.get_text()
            titleslug = re.findall(r"/desconto/(.*)",href.get("href"))
            initials = titleslug[0][0].upper()
            url = href.get("href")
            description = ""
            now = time.strftime("%Y-%m-%d %H:%M:%S")
            slug = 0
            store_id = 0
            for store in stores:
                if store[6] == titleslug[0]:
                    slug = 1
                    if store[5] =="":
                        store_id = store[0]
            #If Need Google Search
            if slug == 0 or store_id != 0:
                link = googleGetURL(name)
            if slug == 0:
                #Insert Stores
                cursor.execute(sqlinsert,(initials,name,description,link,url,titleslug,now,now))
                logging.info("Insert Store name: %s" % name)
            if store_id != 0:
                #Update Stores
                cursor.execute(sqlupdate,(link,url,now,store_id))
                logging.info("Update Store name: %s" % name)
            #Colse SQL
            cursor.close()
            conn.commit()
            conn.close()
            #Sleep 60s-600s
            t = int(random.uniform(60, 600))
            logging.info("Sleep Start : %s" % time.strftime("%Y-%m-%d %H:%M:%S"))
            logging.info("Sleep : %ss" % t)
            time.sleep(t)
        #Today End!
        t1 = (datetime.datetime.strptime((str(datetime.date.today()+datetime.timedelta(1))+" 00:00:00"),'%Y-%m-%d %H:%M:%S')-datetime.datetime.now()).seconds+int(random.uniform(600, 6000))
        logging.info("Today End! Start Sleep %ss (Sleep Till Tomorrow)" % t1)
        time.sleep(t1)