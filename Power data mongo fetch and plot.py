
# coding: utf-8

# In[ ]:


import pandas as pd
import numpy as np
import pymongo as pm
import seaborn as sb
import matplotlib.pyplot as plt
import datetime as dt
import time


# In[ ]:


con = pm.MongoClient("10.129.23.41", 27017)
db = con['data']
dbb = db['power_k_lh_a']

# docs=dbb.find({"TS":{"$gt":1502464200,"$lt":1502481900} })
# docs=dbb.find({"TS":{"$gt":1507558199,"$lt":1507558201} })
docs1=dbb.find({"TS":{"$gt":1507563899,"$lt":1507563901} })


W=[]
TS=[]
FwdWh=[]
TS1=0
TS2=0
for doc in docs:
    W.append(doc['W1']+doc['W2']+doc['W3'])
    FwdWh.append(doc['FwdWh'])
    TS.append(dt.datetime.fromtimestamp(doc['TS']))
    if(doc['W1']+doc['W2']+doc['W3']>2500 or doc['W1']+doc['W2']+doc['W3']==0):
        print dt.datetime.fromtimestamp(doc['TS'])
print len(W)
for doc in docs:
    if(doc['W1']+doc['W2']+doc['W3']>0):
        TS1=doc['TS']
        A=doc['FwdWh']
        break
#     TS.append(dt.datetime.fromtimestamp(int(doc['TS'])))

for doc in docs:
#     W.append(doc['W1']+doc['W2']+doc['W3'])
    if(doc['TS']>TS1 and doc['W1']+doc['W2']+doc['W3']==0):
        print dt.datetime.fromtimestamp(doc['TS'])
        TS2=doc['TS']
        B=doc['FwdWh']
#         break

# TS.append(dt.datetime.fromtimestamp(int(doc['TS'])))

# print doc1['FwdWh']-doc['FwdWh']

print "--------"
print dt.datetime.fromtimestamp(TS1)
print dt.datetime.fromtimestamp(TS2)
print "HVAC on time: "+str((TS[len(TS)-1]-TS[0])/60)+"Mins"
print FwdWh[len(FwdWh)-1]-FwdWh[0]

plt.plot(TS, W)
plt.xticks(rotation=70)
plt.ylabel('W')
plt.show()

