/*
  AJ Alves.
  aj.alves@live.com
*/

#ifndef Continuous2Wheels
#define Continuous2Wheels

#include <WProgram.h>
#include <Servo.h>

/********************************************************************
 * DECLARATIONS
 ********************************************************************/

class Continuous2Wheels{
	public:
		int _speed = STOPED;
		int _direction = IDLE;
		
		Continuous2Wheels(int rigthWhreelPin, int leftWhreelPin, double wheellRadius, double bendRadius);
		void stop();
		void forward(int speed);
		void backward(int speed);
		void forward(int speed, int distance);
		void backward(int speed, int distance);
		void rigthBend(int degree);
		void leftBend(int degree);
		void spin(int degree);
		void spin(int degree, int speed);
		
	private:
		#define STOPED 90
		#define PI 3.14159265
		#define RAD 0.017453292
		#define RIGTHWHEEL 1
		#define LEFTWHEEL 2
		#define IDLE 0
		#define FORWARD 1
		#define BACKWARD 2
		
		Servo _rightWheel = null;
		Servo _leftWheel = null;
		double _wheelRadius = 0.0;
		double _bendRadius = 0.0;

		int getSpeed(int speed, int wheel);
		double degreeToRadian(int degree);
		double getDesplacement(double radians, double radius);
		unsigned long getWaitValue(double desplacement, int speed);
};

/********************************************************************
 * IMPLEMENTATION
 ********************************************************************/

Continuous2Wheels::Continuous2Wheels(int rigthWhreelPin, int leftWhreelPin, double wheellRadius, double bendRadius){
	//attaching referred pins to associatives whreels
  _rightWheel.attach(rigthWhreelPin);
	_leftWheel.attach(leftWhreelPin);
	_wheelRadius = wheellRadius;
	_bendRadius = bendRadius;
	_rightWheel.write(STOPED);
  _leftWheel.write(STOPED);
}

void Continuous2Wheels::stop(){
	_direction = IDLE;
	_rightWheel.write(STOPED);
  _leftWheel.write(STOPED);
  _speed = STOPED;
}

void Continuous2Wheels::forward(int speed){
	_direction = FORWARD;
  _rightWheel.write(STOPED + speed);
  _leftWheel.write(STOPED - speed);
  _speed = speed;
}

void Continuous2Wheels::forward(int speed, int distance){
  _rightWheel.write(STOPED + speed);
  _leftWheel.write(STOPED - speed);
  delay(time);
  Continuous2Wheels::stop();
}

void Continuous2Wheels::backward(int speed){
  _direction = BACKWARD;
  _rightWheel.write(STOPED - speed);
  _leftWheel.write(STOPED + speed);
  _speed = speed;
}

void Continuous2Wheels::backward(int speed, int distance){
  _rightWheel.write(STOPED - speed);
  _leftWheel.write(STOPED + speed);
  delay(time);
  Continuous2Wheels::stop();
}

void Continuous2Wheels::rigthBend(int degree){
	double radians = Continuous2Wheels::degreeToRadian(degree);
	double desplacement = Continuous2Wheels::getDesplacement(radians, _bendRadius);
	unsigned long waitValue = Continuous2Wheels::waitValue(desplacement, _speed);
	_rightWheel.write(STOPED);
	delay(waitValue);
	_rightWheel.write(getSpeed(_speed, RIGTHWHEEL));
}

void Continuous2Wheels::leftBend(int degree){
	double radians = Continuous2Wheels::degreeToRadian(degree);
	double desplacement = Continuous2Wheels::getDesplacement(radians, _bendRadius);
	unsigned long waitValue = Continuous2Wheels::waitValue(desplacement, _speed);
	_leftWheel.write(STOPED);
	delay(waitValue);
	_leftWheel.write(getSpeed(_speed, LEFTWHEEL));
}

void Continuous2Wheels::spin(int degree){
	double radians = Continuous2Wheels::degreeToRadian(degree);
	double desplacement = Continuous2Wheels::getDesplacement(radians, (double radius / 2) );
	if(desplacement < 0){
		desplacement = desplacement * -1;
	}
	int speed = STOPED / 2;
	unsigned long waitValue = Continuous2Wheels::waitValue(desplacement, speed);
	if(degree < 0){
		_rightWheel.write(speed);
		_leftWheel.write(speed * -1);
	}else if{
		_rightWheel.write(speed * -1);
		_leftWheel.write(speed);
	}
	delay(waitValue);
  Continuous2Wheels::stop();
}

void Continuous2Wheels::spin(int degree, int speed){
	double radians = Continuous2Wheels::degreeToRadian(degree);
	double desplacement = Continuous2Wheels::getDesplacement(radians, (double radius / 2) );
	if(desplacement < 0){
		desplacement = desplacement * -1;
	}
	unsigned long waitValue = Continuous2Wheels::waitValue(desplacement, speed);
	if(degree < 0){
		_rightWheel.write(speed);
		_leftWheel.write(speed * -1);
	}else if{
		_rightWheel.write(speed * -1);
		_leftWheel.write(speed);
	}
	delay(waitValue);
  Continuous2Wheels::stop();
}

int Continuous2Wheels::getSpeed(int speed, int wheel){
	switch(_direction){
		default:
		case IDLE :
			return STOPED;
		case FORWARD :
			if(wheel == RIGTHWHEEL){
				return STOPED + speed;
			}else{
				return STOPED - speed;
			}
		case BACKWARD :
			if(wheel == RIGTHWHEEL){
				return STOPED - speed;
			}else{
				return STOPED + speed;
			}
	}
}

double Continuous2Wheels::degreeToRadian(int degree){
	return (RAD * degree);
}

double Continuous2Wheels::getDesplacement(double radians, double radius){
	return (radians * radius);
}

unsigned long Continuous2Wheels::getWaitValue(double desplacement, int speed){
	return (( desplacement / speed) * 10000);
}

#endif
