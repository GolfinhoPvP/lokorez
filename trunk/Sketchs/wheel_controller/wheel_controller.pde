/*
  AJ Alves.
  aj.alves@live.com
*/

/********************************************************************
 * ONLY IMPLEMENTATION
 ********************************************************************/
 
#include <Servo.h>

/********************************************************************
 * CONSTANTS
 ********************************************************************/
// helpers value
#define MILI 1000 //value for 1 second in milliseconds
#define STOPED 90 //Value in which the continuous Servo motors is stopped, its variation is between 0 to 180
#define PI 3.14159265 //Math PI value
#define RAD 0.017453292 //Math RADIANS value
//machine wheels reference
#define RIGHTWHEEL 1 //right wheel
#define LEFTWHEEL 2 //left wheel
//machine motion state
#define IDLE 0 //It sights machine is stopped
#define FORWARD 1 //It sights machine is moving to forward
#define BACKWARD 2 //It sights machine is moving to backward
#define SERIAL_BAUD_DEFAULT 9600 //Baud rate of Serial communication
#define RESISTENCE_DEFAULT 0 //Perfect world resistance
#define BEND_SMOOTH_DEFAULT 0.0 //Bend smooth value default does't attenuate nothing
#define MAXIMUM_SPEED 90 //Maximum speed who a Servo reaches
#define MINIMUM_SPEED 0 //Minimum value who a Servo sets *STOPED

int _speed; //Holds the actual machine' speed
int _direction; //Holds the actual motion direction of machine
double _resistence; //Holds the resistance from middle into the wheels, in a ideal scenery it is zero
boolean _debug; //Holds the mode of log messages from this header
long _serialPortBaud; //Holds the baud value for the serial port communication, by default 9600
float _bendSmooth; //Holds the smooth value to attenuate bends movies

Servo _rightWheel; //Holds the Servo object which will work with the right wheel
Servo _leftWheel; //Holds the Servo object which will work with the left wheel
double _wheelRadius; //Holds the wheel radios value
double _bendRadius; //Holds the bend radius value


//-----------------------------------------------------------------------------------------------------------------
int rwp = 9;
int lwp = 10;
double wr = 3.6;
double br = 12.2;
double r = 2.6;
//-----------------------------------------------------------------------------------------------------------------

void setup(){
  init(rwp, lwp, wr, br, r);
  debugMode(true);
  setBendSmooth(0.2); //--------------------------------------------------------------------------AJUSTAND AS CURVAS
}

void loop(){
  delay(10000);
  forward(45);
  delay(4000);
  rigthBend(90);
  delay(4000);
  backward(45);
  delay(4000);
  rigthBend(90);
  forward(45);
  leftBend(90);
  delay(4000);
  backward(45);
  delay(4000);
  leftBend(90);
  delay(4000);
  stop();
  forward(45, 100);
  backward(45, 40);
  spin(180);
  forward(45, 60);
  spin(-180);
  delay(100000000);
}

void init(int rightWhreelPin, int leftWhreelPin, double wheellRadius, double bendRadius) {
  //Start the serial communication but with the debug mode off
  _serialPortBaud = SERIAL_BAUD_DEFAULT;
  Serial.begin(_serialPortBaud);
  _debug = false;
  //attaching referred pins to associative wheels
  _rightWheel.attach(rightWhreelPin);
  _leftWheel.attach(leftWhreelPin);
  //Setting the initial values
  _wheelRadius = wheellRadius;
  _bendRadius = bendRadius;
  _rightWheel.write(STOPED);
  _leftWheel.write(STOPED);
  _speed = STOPED;
  _direction = IDLE;
  //Setting the resistance value
  _resistence = RESISTENCE_DEFAULT;
  //Setting the bend smooth
  _bendSmooth = BEND_SMOOTH_DEFAULT;
}

void init(int rightWhreelPin, int leftWhreelPin, double wheellRadius, double bendRadius, double resistence) {
 //Start the serial communication but with the debug mode off
 _serialPortBaud = SERIAL_BAUD_DEFAULT;
 Serial.begin(_serialPortBaud);
 _debug = false;
 //attaching referred pins to associative wheels
 _rightWheel.attach(rightWhreelPin);
 _leftWheel.attach(leftWhreelPin);
 //Setting the initial values
 _wheelRadius = wheellRadius;
 _bendRadius = bendRadius;
 _rightWheel.write(STOPED);
 _leftWheel.write(STOPED);
 _speed = STOPED;
 _direction = IDLE;
 //Setting the resistance value
 _resistence = resistence;
 //Setting the bend smooth
 _bendSmooth = BEND_SMOOTH_DEFAULT;
}

void stop() {
	_direction = IDLE;
	_rightWheel.write(STOPED);
	_leftWheel.write(STOPED);
	_speed = STOPED;
}

void forward(int speed){
  speed = speedFormater(speed);
  _direction = FORWARD;
  _rightWheel.write(STOPED + speed);
  _leftWheel.write(STOPED - speed);
  _speed = speed;
}

void forward(int speed, double distance) {
	speed = speedFormater(speed);
	//get the walk value of wheel displacement
	double displacement = getWalkDisplacement(distance);
	//get the among of time to wait to reach the displacement
	unsigned long waitValue = getWaitValue(displacement, speed);
	//start the motion
	_rightWheel.write(STOPED + speed);
	_leftWheel.write(STOPED - speed);
	//wait until to reach the target
	delay(waitValue);
	//stop the machine
	stop();
	if (_debug) {
		Serial.print("backward(int speed, double distance) -> Displacement: ");
		Serial.print(displacement);
		Serial.print(", Waiting: ");
		Serial.println(waitValue);
	}
}

void backward(int speed) {
	speed = speedFormater(speed);
	_direction = BACKWARD;
	_rightWheel.write(STOPED - speed);
	_leftWheel.write(STOPED + speed);
	_speed = speed;
}

void backward(int speed, double distance) {
	speed = speedFormater(speed);
	//get the walk value of wheel displacement
	double displacement = getWalkDisplacement(distance);
	//get the among of time to wait to reach the displacement
	unsigned long waitValue = getWaitValue(displacement, speed);
	//start the motion
	_rightWheel.write(STOPED - speed);
	_leftWheel.write(STOPED + speed);
	//wait until to reach the target
	delay(waitValue);
	//stop the machine
	stop();
	if (_debug) {
		Serial.print("backward(int speed, double distance) -> Displacement: ");
		Serial.print(displacement);
		Serial.print(", Waiting: ");
		Serial.println(waitValue);
	}
}

void bend(int degree) {
	if (degree > 0) {
		rigthBend(degree);
	} else if (degree < 0) {
		degree *= -1;
		leftBend(degree);
	}
	if (_debug) {
		Serial.print("bend(int degree) -> Radians: ");
		Serial.println(degree);
	}
}

void rigthBend(int degree) {
	if (degree < 0) {
		degree = 0;
	}
	//Get the raidians value from the degree
	double radiansVal = degreeToRadian(degree);
	//get the walk value of wheel displacement
	double displacement = getCircleDisplacement(radiansVal, _bendRadius);
	//get the among of time to wait to reach the displacement
	unsigned long waitValue = getWaitValue(displacement, _speed);
	//adjust the right wheel for a bend
	_rightWheel.write(STOPED + (_speed * _bendSmooth));
	//wait until to reach the target
	delay(waitValue);
	//restart the motion
	_rightWheel.write(getWheelSpeed(_speed, RIGHTWHEEL));
	if (_debug) {
		Serial.print("rigthBend(int degree) -> Radians: ");
		Serial.print(radiansVal);
		Serial.print(", Displacement: ");
		Serial.print(displacement);
		Serial.print(", Waiting: ");
		Serial.println(waitValue);
	}
}

void leftBend(int degree) {
	if (degree < 0) {
		degree = 0;
	}
	//Get the raidians value from the degree
	double radiansVal = degreeToRadian(degree);
	//get the walk value of wheel displacement
	double displacement = getCircleDisplacement(radiansVal, _bendRadius);
	//get the among of time to wait to reach the displacement
	unsigned long waitValue = getWaitValue(displacement, _speed);
	//adjust the left wheel for a bend
	_leftWheel.write(STOPED - (_speed * _bendSmooth));
	//wait until to reach the target
	delay(waitValue);
	//restart the motion
	_leftWheel.write(getWheelSpeed(_speed, LEFTWHEEL));
	if (_debug) {
		Serial.print("leftBend(int degree) -> Radians: ");
		Serial.print(radiansVal);
		Serial.print(", Displacement: ");
		Serial.print(displacement);
		Serial.print(", Waiting: ");
		Serial.println(waitValue);
	}
}

void spin(int degree) {
	//Get the raidians value from the degree
	double radiansVal = degreeToRadian(degree);
	//get the walk value of wheel displacement now using the bend radius, it will make the machine spin in itself
	double displacement = getCircleDisplacement(radiansVal, (_bendRadius / 2));
	//by defaul the spin is made with a half maximum speed
	int speed = STOPED / 2;
	//get the among of time to wait to reach the displacement
	unsigned long waitValue = getWaitValue(displacement, speed);
	//from the sign of passed param choice the right direction
	if (degree < 0) {
		_rightWheel.write(speed);
		_leftWheel.write(speed * -1);
	} else {
		_rightWheel.write(speed * -1);
		_leftWheel.write(speed);
	}
	//wait until to reach the target
	delay(waitValue);
	//STOP THE MACHINE - FOR THE TIME BEING
	stop();
	if (_debug) {
		Serial.print("spin(int degree) -> Radians: ");
		Serial.print(radiansVal);
		Serial.print(", Displacement: ");
		Serial.print(displacement);
		Serial.print(", Waiting: ");
		Serial.println(waitValue);
	}
}

void spin(int degree, int speed) {
	speed = speedFormater(speed);
	//Get the raidians value from the degree
	double radiansVal = degreeToRadian(degree);
	//get the walk value of wheel displacement now using the bend radius, it will make the machine spin in itself
	double displacement = getCircleDisplacement(radiansVal, (_bendRadius / 2));
	//get the among of time to wait to reach the displacement
	unsigned long waitValue = getWaitValue(displacement, speed);
	//from the sign of passed param choice the right direction
	if (degree < 0) {
		_rightWheel.write(speed);
		_leftWheel.write(speed * -1);
	} else {
		_rightWheel.write(speed * -1);
		_leftWheel.write(speed);
	}
	//wait until to reach the target
	delay(waitValue);
	//STOP THE MACHINE - FOR THE TIME BEING
	stop();
	if (_debug) {
		Serial.print("spin(int degree, int speed) -> Radians: ");
		Serial.print(radiansVal);
		Serial.print(", Displacement: ");
		Serial.print(displacement);
		Serial.print(", Waiting: ");
		Serial.println(waitValue);
	}
}

void debugMode(boolean mode){
  Serial.println("Debug mode is ON!");
  _debug = mode;
}

void setDebugMode(boolean mode) {
	if (mode) {
		Serial.println("Debug mode is ON!");
	} else {
		Serial.println("Debug mode is OFF!");
	}
	_debug = mode;
}


//Method to get the speed value
int getSpeed() {
	return _speed;
}

//Method to get direction value
int getDirection() {
	return _direction;
}

//Method to get the bend smooth value
float getBendSmooth() {
	return _bendSmooth;
}

//Method to set the bend smooth***** value
void setBendSmooth(float smooth) {
	if (_debug) {
		Serial.print("Smooth changed to ");
		Serial.println(smooth);
	}
	if(smooth < 0.0){
		smooth = 0.0;
	}else if(smooth > 1.0){
		smooth = 1.0;
	}
	_bendSmooth = smooth;
}

//Method to get the baud value of serial port communication
long getSerialPortBaud() {
	return _serialPortBaud;
}

//Method to set the baud value of serial port communication
void setSerialPortBaud(long baud) {
	if (_debug) {
		Serial.print("Serial baud has changed to ");
		Serial.println(baud);
	}
	_serialPortBaud = baud;
	Serial.end();
	Serial.begin(_serialPortBaud);
}

//----------------------------------------------------------------------------------------

int getWheelSpeed(int speed, int wheel) {
	switch (_direction) {
	default:
	case IDLE:
		return STOPED;
		break;
	case FORWARD:
		if (wheel == RIGHTWHEEL) {
			return STOPED + speed;
		} else {
			return STOPED - speed;
		}
		break;
	case BACKWARD:
		if (wheel == RIGHTWHEEL) {
			return STOPED - speed;
		} else {
			return STOPED + speed;
		}
		break;
	}
}

double degreeToRadian(int degree){
  return (RAD * degree);
}

double getCircleDisplacement(double radiansV, double radius) {
	return (radiansV * radius);
}

double getWalkDisplacement(double distance) {
	unsigned int degree = (360 * distance) / circleLength(_wheelRadius);
	double radiansV = degreeToRadian(degree);
	if (_debug) {
		Serial.print("getWalkDisplacement() -> Degree: ");
		Serial.print(degree);
		Serial.print(", Length: ");
		Serial.print(circleLength(_wheelRadius));
		Serial.print(", Radians: ");
		Serial.println(radiansV);
	}
	return getCircleDisplacement(radiansV, _wheelRadius);
}

double circleLength(double radius) {
	return 2 * PI * radius;
}

unsigned long getWaitValue(double displacement, int speed) {
	return ((((displacement / speed) * MILI) * _resistence) * (1 + _bendSmooth));
}

int speedFormater(int speed) {
	if (speed < 0) {
		speed = 0;
	} else if (speed > 90) {
		speed = 90;
	}
	return speed;
}
