#!/usr/bin/env python
#-*- coding:utf-8 -*-

#imports
import serial
import MySQLdb
from datetime import datetime

# Definição de Variáveis

# Banco MySql
db_host = "localhost"
db_user = "root"
db_password = "root"
database = "arduino"

# Programa Principal

# Conexão com o banco
db_connection = MySQLdb.connect(db_host, db_user, db_password)
db_connection.select_db(database)

cursor = db_connection.cursor()

# Serial
boud = 9600
serial_port = "/dev/ttyUSB0"
time = 10

# Abrindo a porta serial
ser = serial.Serial(serial_port, boud, timeout=time)
ser.readline()

while True:
	date = datetime.now()

	# Formatando a data para string
	year = date.year
	month = date.month
	day = date.day
	hour = date.hour
	minute = date.minute
	second = date.second

	formated_data = "%s-%s-%s %s:%s:%s" % (year, month, day, hour, minute, second)

	# Lendo a porta serial
	info = ser.readline()

	response = info.split(",")
	
	#print response[0]
	temperature = float(response[0])
	voltage = float(response[1])

	sql = "insert into temperatures (date, temperature, voltage) values ('%s', %d, %f)" % (formated_data, temperature, voltage)
	cursor.execute(sql)
	db_connection.commit()

	print "Temperatura: %d C e Tensão: %f" % (temperature, voltage)

