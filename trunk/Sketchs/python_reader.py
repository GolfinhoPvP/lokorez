from serial import Serial
from send_email import mandar_email

port = "/dev/ttyACM1"

ser = Serial(port, 19200, timeout=10)
ser.readline()
info = ser.readline()
print info
	
ser.close()
mensagem = "Nada mais nada"
mandar_email(mensagem)
