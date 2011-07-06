int  ledPin = 13;
int sensorPin = 0;
int period = 400;

int limit = 1000;

int acesso =  0;

void setup(){
  Serial.begin(9600);
  pinMode(ledPin, OUTPUT);
}

void loop(){
  int rawValue = analogRead(sensorPin);
  
  if(rawValue < limit){
    digitalWrite(ledPin, LOW);
    if(acesso != 1){
      acesso = 1;
      Serial.print(rawValue);
      Serial.println(" light is on");
    }
  }else{
    digitalWrite(ledPin, HIGH);
    if(acesso != 0){
      acesso = 0;
      Serial.print(rawValue);
      Serial.println(" light is off");
    }
  }
  delay(period);
}
