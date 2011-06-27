int pin = 2;

void setup(){
   Serial.begin(9600);
   pinMode(pin, INPUT);
}

void loop(){
  Serial.print("valor voltagem: ");
  Serial.println(digitalRead(pin));
  delay(1000);
}
