int ledPin = 13;
int tempoEspera = 500;

void setup(){
  pinMode(ledPin, OUTPUT);
  Serial.begin(9600);
}

void loop(){
  char ch;
  if(Serial.available()){
    ch = Serial.read();
    if(ch == '0'){
      digitalWrite(ledPin, LOW);
    }else{
      digitalWrite(ledPin, HIGH);
    }
  }
  delay(tempoEspera);
}
