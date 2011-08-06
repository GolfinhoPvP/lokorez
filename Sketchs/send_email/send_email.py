import sys
import smtplib
from email.MIMEText import MIMEText

to = 'zerokol@ymail.com'
user = 'aj.zerokol@gmail.com'
password = '0ImBurned0'

def mandar_email(mensagem):
	msg = MIMEText(mensagem)
	msg['Subject'] = 'Teste'
	msg['From'] = "Chefe Apache"
	msg['Reply-to'] = "Marvin Lemos Curso"
	msg['To'] = to
	
	smtpserver = smtplib.SMTP("smtp.gmail.com",587)
	smtpserver.ehlo()
	smtpserver.starttls()
	smtpserver.ehlo
	smtpserver.login(user, password)
	try:
		smtpserver.sendmail(user,to,
		msg.as_string())
		print "e-mail encaminhado"
	except:
		print "falha ao transmitir e-mail"
		print sys.exc_info()
		smtpserver.close()
