int inPin = 2;
int ledPin_1 = 4;
int ledPin_2 = 5;
int val = 0;
int counter = 0;
int last = 0;

void setup(){
   pinMode(inPin, INPUT);
   pinMode(ledPin_1, OUTPUT);
   pinMode(ledPin_2, OUTPUT);
}

void loop(){
  val = digitalRead(inPin);
  if(val == HIGH and val != last){
    last = val;
    if(counter == 3){
      counter = 0;
    }else{
      counter++;
    }
  }else if(val == LOW){
    last = 0;
  }
  switch(counter){
    case 0:
    default:
       ledOff();
       break;
    case 1:
      ledOn();
      break;
    case 2:
      ledBlink();
      break;
    case 3:
      ledSiren();
      break;
  }
}

void ledOn(){
  digitalWrite(ledPin_1, HIGH);
  digitalWrite(ledPin_2, HIGH);
}

void ledOff(){
  digitalWrite(ledPin_1, LOW);
  digitalWrite(ledPin_2, LOW);
}

void ledBlink(){
  ledOn();
  delay(300);
  ledOff();
  delay(300);
}

void ledSiren(){
  digitalWrite(ledPin_1, HIGH);
  digitalWrite(ledPin_2, LOW);
  delay(300);
  digitalWrite(ledPin_1, LOW);
  digitalWrite(ledPin_2, HIGH);
  delay(300);
}
