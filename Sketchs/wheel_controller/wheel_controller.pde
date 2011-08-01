/*
  AJ Alves.
  aj.alves@live.com
*/

/********************************************************************
 * IMPLEMENTATION
 ********************************************************************/
 
#include <Servo.h>

#define STOPED 90
#define PI 3.14159265
#define RAD 0.017453292
#define RIGTHWHEEL 1
#define LEFTWHEEL 2
#define IDLE 0
#define FORWARD 1
#define BACKWARD 2
#define MILI 1000
		
Servo _rightWheel;
Servo _leftWheel;
double _wheelRadius;
double _bendRadius;
int _speed;
int _direction;
double _resistence;
boolean _debug;

int rwp = 9;
int lwp = 10;
double wr = 3.6;
double br = 12.2;
double r = 2.6;

void setup(){
  init(rwp, lwp, wr, br, r);
  debugMode(true);
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
  stopWheels();
  forward(45, 100);
  backward(45, 40);
  spin(180);
  forward(45, 60);
  spin(-180);
  delay(100000000);
}

void init(int rigthWhreelPin, int leftWhreelPin, double wheellRadius, double bendRadius){
  Serial.begin(9600);
  _rightWheel.attach(rigthWhreelPin);
  _leftWheel.attach(leftWhreelPin);
  _wheelRadius = wheellRadius;
  _bendRadius = bendRadius;
  _rightWheel.write(STOPED);
  _leftWheel.write(STOPED);
  _speed = STOPED;
  _direction = IDLE;
  _debug = false;
}

void init(int rigthWhreelPin, int leftWhreelPin, double wheellRadius, double bendRadius, double resistence){
  Serial.begin(9600);
  _rightWheel.attach(rigthWhreelPin);
  _leftWheel.attach(leftWhreelPin);
  _wheelRadius = wheellRadius;
  _bendRadius = bendRadius;
  _rightWheel.write(STOPED);
  _leftWheel.write(STOPED);
  _speed = STOPED;
  _direction = IDLE;
  _resistence = resistence;
  _debug = false;
}

void stopWheels(){
  _direction = IDLE;
  _rightWheel.write(STOPED);
  _leftWheel.write(STOPED);
  _speed = STOPED;
}

void forward(int speed){
  _direction = FORWARD;
  _rightWheel.write(STOPED + speed);
  _leftWheel.write(STOPED - speed);
  _speed = speed;
}

void forward(int speed, double distance){
  _rightWheel.write(STOPED + speed);
  _leftWheel.write(STOPED - speed);
  double desplacement = getWalkDesplacement(distance);
  unsigned long waitValue = getWaitValue(desplacement, speed);
  delay(waitValue);
  stopWheels();
  if(_debug){
    Serial.print("backward(int speed, double distance) -> Desplacement: ");
    Serial.print(desplacement);
    Serial.print(", Waiting: ");
    Serial.println(waitValue);
  }
}

void backward(int speed){
  _direction = BACKWARD;
  _rightWheel.write(STOPED - speed);
  _leftWheel.write(STOPED + speed);
  _speed = speed;
}

void backward(int speed, double distance){
  _rightWheel.write(STOPED - speed);
  _leftWheel.write(STOPED + speed);
  double desplacement = getWalkDesplacement(distance);
  unsigned long waitValue = getWaitValue(desplacement, speed);
  delay(waitValue);
  stopWheels();
  if(_debug){
    Serial.print("backward(int speed, double distance) -> Desplacement: ");
    Serial.print(desplacement);
    Serial.print(", Waiting: ");
    Serial.println(waitValue);
  }
}

void rigthBend(int degree){
  if(degree < 0){
    degree = 0;
  }
  double radiansV = degreeToRadian(degree);
  double desplacement = getDesplacement(radiansV, _bendRadius);
  unsigned long waitValue = getWaitValue(desplacement, _speed);
  _rightWheel.write(STOPED);
  delay(waitValue);
  _rightWheel.write(getSpeed(_speed, RIGTHWHEEL));
  if(_debug){
    Serial.print("rigthBend(int degree) -> Radians: ");
    Serial.print(radiansV);
    Serial.print(", Desplacement: ");
    Serial.print(desplacement);
    Serial.print(", Waiting: ");
    Serial.println(waitValue);
  }
}

void leftBend(int degree){
  if(degree < 0){
    degree = 0;
  }
  double radiansV = degreeToRadian(degree);
  double desplacement = getDesplacement(radiansV, _bendRadius);
  unsigned long waitValue = getWaitValue(desplacement, _speed);
  _leftWheel.write(STOPED);
  delay(waitValue);
  _leftWheel.write(getSpeed(_speed, LEFTWHEEL));
  if(_debug){
    Serial.print("leftBend(int degree) -> Radians: ");
    Serial.print(radiansV);
    Serial.print(", Desplacement: ");
    Serial.print(desplacement);
    Serial.print(", Waiting: ");
    Serial.println(waitValue);
  }
}

void spin(int degree){
  double radiansV = degreeToRadian(degree);
  double desplacement = getDesplacement(radiansV, (_bendRadius / 2) );
  if(desplacement < 0){
    desplacement = desplacement * -1;
  }
  int speed = STOPED / 2;
  unsigned long waitValue = getWaitValue(desplacement, speed);
  if(degree < 0){
    _rightWheel.write(speed);
    _leftWheel.write(speed * -1);
  }else{
    _rightWheel.write(speed * -1);
    _leftWheel.write(speed);
  }
  delay(waitValue);
  stopWheels();
  if(_debug){
    Serial.print("spin(int degree) -> Radians: ");
    Serial.print(radiansV);
    Serial.print(", Desplacement: ");
    Serial.print(desplacement);
    Serial.print(", Waiting: ");
    Serial.println(waitValue);
  }
}

void spin(int degree, int speed){
  double radiansV = degreeToRadian(degree);
  double desplacement = getDesplacement(radiansV, (_bendRadius / 2) );
  if(desplacement < 0){
    desplacement = desplacement * -1;
  }
  unsigned long waitValue = getWaitValue(desplacement, speed);
  if(degree < 0){
    _rightWheel.write(speed);
    _leftWheel.write(speed * -1);
  }else{
    _rightWheel.write(speed * -1);
    _leftWheel.write(speed);
  }
  delay(waitValue);
  stopWheels();
  if(_debug){
    Serial.print("spin(int degree, int speed) -> Radians: ");
    Serial.print(radiansV);
    Serial.print(", Desplacement: ");
    Serial.print(desplacement);
    Serial.print(", Waiting: ");
    Serial.println(waitValue);
  }
}

void debugMode(boolean mode){
  Serial.println("Debug mode is ON!");
  _debug = mode;
}

int getSpeed(int speed, int wheel){
  switch(_direction){
    default:
    case IDLE :
      return STOPED;
      break;
    case FORWARD :
      if(wheel == RIGTHWHEEL){
        return STOPED + speed;
      }else{
	return STOPED - speed;
      }
      break;
    case BACKWARD :
      if(wheel == RIGTHWHEEL){
        return STOPED - speed;
      }else{
        return STOPED + speed;
      }
      break;
  }
}

double degreeToRadian(int degree){
  return (RAD * degree);
}

double getDesplacement(double radiansV, double radius){
  return (radiansV * radius);
}

double getWalkDesplacement(double distance){
  unsigned int degree = (360 * distance) / compriment(_wheelRadius);
  double radiansV = degreeToRadian(degree);
  if(_debug){
    Serial.print("getWalkDesplacement() -> Degree: ");
    Serial.print(degree);
    Serial.print(", Compriment: ");
    Serial.print(compriment(_wheelRadius));
    Serial.print(", Radians: ");
    Serial.println(radiansV);
  }
  return getDesplacement(radiansV, _wheelRadius);
}

double compriment(double radius){
  return 2 * PI * radius;
}

unsigned long getWaitValue(double desplacement, int speed){
  return ((( desplacement / speed) * MILI) * _resistence);
}
