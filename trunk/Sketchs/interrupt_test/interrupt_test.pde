int temperaturaPin = 0;
int ledPin = 13;
float vIn = 5.0;
int inPin = 2;

void setup(){
  Serial.begin(9600);
  pinMode(inPin, INPUT);
  pinMode(ledPin, OUTPUT);
  
  attachInterrupt(0, printWarn, RISING);
}

void loop(){
    digitalWrite(ledPin, HIGH);
    float leitura = analogRead(temperaturaPin);
    
    float tensao = (leitura * vIn) / 1023.0;
    
    Serial.print(tensao);
    Serial.println(" volts.");
    
    float temperaturaC = tensao * 100.0;
    
    delay(1000);
    Serial.print(temperaturaC);
    Serial.println(" graus em C.");
    Serial.println(" ");
    
    digitalWrite(ledPin, LOW);
    
    delay(1000);
}

void printWarn(){
  Serial.print("Warn");
}
