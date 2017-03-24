#!/Library/Frameworks/Python.framework/Versions/Current/bin/python
# -*- coding: UTF-8 -*-
import requests
import time,datetime
import random
import MySQLdb
import logging
from bs4 import BeautifulSoup
import re
import os

def getHtml(url):
    try:
        user_agent = 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36'
        headers = {
            'User-Agent' : user_agent,
            'Referer':'http://www.google.com/'
            }
        html = requests.get(url,headers=headers)
        return html
    except:
        logging.info("Meliuz Say No!~")
        return ""
def getSoup(html):
    soup = BeautifulSoup(str(html.content), "html.parser")
    return soup
def getOffers(soup):
    try:
        offers = soup.find_all("li",attrs={"class": "d-b bg--white box--round box--shadow mb- coupon-container"})
        return offers
    except:
        logging.info("No Offers!")
        return ""

def getName(offer):
    pattern = r'target="_blank">  (.*)  </a> </h3>'
    name = re.findall(pattern,str(offer))
    if name == []:
        return ""
    else:
        return name
def getDescription(offer):
    pattern = r'<p>(.*)</p>'
    desc = re.findall(pattern,str(offer))
    if desc == []:
        desc = ""
    else:
        desc = desc[0]
    re_h = re.compile(r'<[^>]+>')
    description = re_h.sub(' ',desc)
    return description
def getCode(offer):
    pattern = r'data-code="(.*)" data-coupon='
    code = re.findall(pattern,str(offer))
    return code
def getImg(soup,store_id):
    try:
        imagename = "/Users/liuzhiguo/Sites/Colpon/public/images/Store-"+str(store_id)+".png"
        imgurl = "http:"+str(soup.find("img",attrs={"class": "d-b box--shadow img--round img--responsive"}).get("src"))
        data=requests.get(imgurl,timeout=30).content
        with open(imagename,'wb') as f:
            f.write(data)
    except:
        logging.info("Store_id : %s Not OK!" % str(store_id))
def ifImg(store_id):
    filename = r'/Users/liuzhiguo/Sites/Colpon/public/images/Store-'+str(store_id)+'.png'
    return os.path.exists(filename)
def main():
    #SQLs
    sqlselectstores = "SELECT * FROM stores"
    sqlselectoffers = "SELECT %s FROM offers WHERE store_id = %s"
    sqlinsertoffers = "INSERT INTO offers (store_id,type,name,description,link,code,status,confirm_date,ends,created_at,updated_at) values (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
    sqlupdateoffers = "UPDATE offers set status = %s, link = %s, confirm_date = %s, ends = %s, updated_at = %s where id = %s"
    sqlupdate = "UPDATE offers set status = %s where store_id = %s"
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
    cursor.execute(sqlselectstores)
    stores = cursor.fetchall()
    for store in stores:
        store_id = store[0]
        link = store[4]
        url = store[5]
        logging.info("url = %s" % url)
        html = getHtml(url)
        if html == "":
            #Today End!
            t1 = (datetime.datetime.strptime((str(datetime.date.today()+datetime.timedelta(1))+" 00:00:00"),'%Y-%m-%d %H:%M:%S')-datetime.datetime.now()).seconds+int(random.uniform(600, 6000))
            logging.info("Html None Today End! Start Sleep %ss (Sleep Till Tomorrow)" % t1)
            time.sleep(t1)
            html = getHtml(url)
        soup = getSoup(html)
        offers = getOffers(soup)
        if ifImg(store_id):
            logging.info("Img it's OK!~")
        else:
            getImg(soup,store_id)
        now = time.strftime("%Y-%m-%d %H:%M:%S")
        #Select Offers
        cursor.execute(sqlselectoffers,('*',store_id))
        select_offers = cursor.fetchall()
        #Update Offers Status = 0
        cursor.execute(sqlupdate,(0,store_id))
        logging.info("Update Offers Status = 0")
        for offer in offers:
            name = getName(offer)
            description = getDescription(offer)
            code = getCode(offer)
            if code == []:
                codetype = "D"
                logging.info("codetype = D")
                code = ""
            else:
                codetype = "C"
                code = code[0]
                logging.info("codetype = C")
            confirm_date = datetime.datetime.now() - datetime.timedelta(days = int(random.uniform(0, 3)), hours = int(random.uniform(1, 23)), minutes = int(random.uniform(1, 59)), seconds = int(random.uniform(1, 59)))
            ends = datetime.datetime.now() + datetime.timedelta(days = int(random.uniform(5, 30)), hours = int(random.uniform(1, 23)), minutes = int(random.uniform(1, 59)), seconds = int(random.uniform(1, 59)))
            n = 0
            offer_id = 0
            for select_offer in select_offers:
                try:
                    if select_offers[3] == name and select_offers[4] == description:
                        n = 1
                        offer_id = select_offers[0]
                except:
                    logging.info("Select Offer Error")
            if n == 0 and name != "" and description != "":
                #Insert Offers
                cursor.execute(sqlinsertoffers,(store_id,codetype,name,description,link,code,1,confirm_date,ends,now,now))
                logging.info("Insert Offers")
            else:
                #Update Offers Status = 1
                cursor.execute(sqlupdateoffers,(1,link,confirm_date,ends,now,offer_id))
                logging.info("Update Offers Status = 1")
            if description == "" and code == "" and n == 0:
                description = 'As melhores ofertas e promoções'
                #Insert Offers
                cursor.execute(sqlinsertoffers,(store_id,"D",name,description,link,"",1,confirm_date,ends,now,now))
                logging.info("No Offer But Insert Offers")
        #Commit
        conn.commit()
        #Sleep 60s-600s
        t = int(random.uniform(30, 200))
        logging.info("Sleep Start : %s" % time.strftime("%Y-%m-%d %H:%M:%S"))
        logging.info("Sleep : %ss" % t)
        time.sleep(t)
    #Colse SQL
    cursor.close()
    conn.close()

if __name__ == '__main__':
    while True:
        #Log
        logging.basicConfig(level=logging.DEBUG,
                    format='%(process)d %(asctime)s %(filename)s[line:%(lineno)d] %(levelname)s %(message)s',
                    datefmt='%a, %d %b %Y %H:%M:%S',
                    filename='Colpon-Offers.log',
                    filemode='w')
        #Today Start
        logging.info("Today Start %s" % time.strftime("%Y-%m-%d %H:%M:%S"))
        main()
        #Today End!
        t1 = (datetime.datetime.strptime((str(datetime.date.today()+datetime.timedelta(1))+" 00:00:00"),'%Y-%m-%d %H:%M:%S')-datetime.datetime.now()).seconds+int(random.uniform(600, 6000))
        logging.info("Today End! Start Sleep %ss (Sleep Till Tomorrow)" % t1)
        time.sleep(t1)
