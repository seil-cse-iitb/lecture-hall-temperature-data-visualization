from datetime import datetime
from MySQLdb import *

def insert_to_db(FwdWh,PF1,PF2,PF3,A3,V23,VLL,VLN,TS,A1,V1,V2,A2,PF,VA1,VA2,VA3,A,VA,FwdVAh,F,W,VAR,V31,VAR1,VAR2,VAR3,V12,FwdVARhR,srl,V3,W1,W2,W3,FwdVARhC):

        con = connect("10.129.23.161","writer","datapool","cooling")
        cur = con.cursor()

        sql  = "insert into power_k_lh_a(FwdWh,PF1,PF2,PF3,A3,V23,VLL,VLN,TS,A1,V1,V2,A2,PF,VA1,VA2,VA3,A,VA,FwdVAh,F,W,VAR,V31,VAR1,VAR2,VAR3,V12,FwdVARhR,srl,V3,W1,W2,W3,FwdVARhC)  values('%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f','%f')" %(FwdWh,PF1,PF2,PF3,A3,V23,VLL,VLN,TS,A1,V1,V2,A2,PF,VA1,VA2,VA3,A,VA,FwdVAh,F,W,VAR,V31,VAR1,VAR2,VAR3,V12,FwdVARhR,srl,V3,W1,W2,W3,FwdVARhC)
        # print sql
        try:
                print "Executing"
                print sql
                cur.execute(sql)
                # print "Executed sql"
                con.commit()
                # print "Insertion done -- Done"
        except:
                con.rollback()
                print "Execution failed -- Rollback in progress.."
        con.close()
