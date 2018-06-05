
# coding: utf-8

# In[128]:


import pandas as pd
import numpy as np
import pymongo as pm
import seaborn as sb
import matplotlib.pyplot as plt
import datetime as dt
import matplotlib
import time


# In[130]:


con = pm.MongoClient("10.129.23.41", 27017)
db = con['data']
dbb = db['temp_k_seil']

fromm=1507314600;
too=1507487400;
# docs=dbb.find({"TS": {"$gt":1507641607,"$lt":1507728007}})
docs=dbb.find({ "$and" : [{"TS": {"$gt":fromm,"$lt":too}}, {"id": 19.0}]})
               
W=[]
TS=[]

for doc in docs:
    W.append(doc['temperature'])
    TS.append(dt.datetime.fromtimestamp(doc['TS']))

# plt.plot(TS, W,'-')
# plt.xticks(rotation=70)
# plt.ylabel('C')
# plt.show()
# print TS[0]


import MySQLdb

db = MySQLdb.connect(host="10.129.23.161", port=3306, user="reader", passwd="datapool", db="cooling")

# print "SELECT timestamp,temperature FROM cooling.temperature_analysis where timestamp>\""+str(dt.datetime.fromtimestamp(fromm))+"\" and timestamp<\""+str(dt.datetime.fromtimestamp(too))+"\""
# print "SELECT timestamp,temperature FROM cooling.temperature_analysis where node_id=\"11\" timestamp>\""+str(dt.datetime.fromtimestamp(fromm))+"\" and timestamp<\""+str(dt.datetime.fromtimestamp(too))+"\""
cursor = db.cursor()
cursor.execute("SELECT timestamp,temperature FROM cooling.temperature_analysis where timestamp>\""+str(dt.datetime.fromtimestamp(fromm))+"\" and timestamp<\""+str(dt.datetime.fromtimestamp(too))+"\"")
rows = cursor.fetchall()
# for row in rows:
#     print row

df = pd.DataFrame( [[ij for ij in i] for i in rows] )
df.rename(columns={0: 'timestamp', 1: 'temperature'}, inplace=True)
# print df
df = df.sort_values(['timestamp'], ascending=[0]);

plt.plot(TS, W,'-',label="Ambient temperature")
plt.plot(df['timestamp'], df['temperature'],'-',linewidth=1,label="Indoor temperature")
plt.legend(bbox_to_anchor=(1.05, 1), loc=2, borderaxespad=0.)
plt.xticks(rotation=70)
plt.grid(True, which='both')
plt.xlabel('Time(7th and 8th Oct)')
plt.ylabel('Temperature(in degree C)')
plt.show()

