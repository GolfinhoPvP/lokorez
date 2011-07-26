int irRigthPin = 7;
int irLeftPin = 6;
int led_pin = 13;

int start_bit = 2000;//Limiar - Start bit (microssegundos)
int bin_1 = 1000;//Binario 1 limiar (microssegundos)
int bin_0 = 400;//Binario 0 limiar (microssegundos)

void setup() {
  Serial.begin(9600);
  pinMode(led_pin, OUTPUT);//O led do p13 acende e mostra que estamos prontos para receber
  
  pinMode(irRigthPin, INPUT);
  pinMode(irLeftPin, INPUT);
  
  digitalWrite(led_pin, LOW);
}

void loop() {
  //long duration1 = pulseIn(irRigthPin, LOW);
  long duration2;
  while((duration2 = pulseIn(irRigthPin, LOW)) < 2200) {
  }
  
  //Serial.print("Duration Rigth: ");
  //Serial.print(duration1);
  Serial.print(" ----------------- ");
  Serial.print(" Duration Left: ");
  Serial.println(duration2);
}

int getIRKey() {
  int data[12];
  digitalWrite(led_pin, HIGH);
  //Ok, Esta pronto para receber os comandos
  while(pulseIn(irRigthPin, LOW) < 2200) { //Espera o start bit
  }
  data[0] = pulseIn(irRigthPin, LOW);//Começa a medir os bits
  data[1] = pulseIn(irRigthPin, LOW);
  data[2] = pulseIn(irRigthPin, LOW);
  data[3] = pulseIn(irRigthPin, LOW);
  data[4] = pulseIn(irRigthPin, LOW);
  data[5] = pulseIn(irRigthPin, LOW);
  data[6] = pulseIn(irRigthPin, LOW);
  data[7] = pulseIn(irRigthPin, LOW);
  data[8] = pulseIn(irRigthPin, LOW);
  data[9] = pulseIn(irRigthPin, LOW);
  data[10] = pulseIn(irRigthPin, LOW);
  data[11] = pulseIn(irRigthPin, LOW);
  digitalWrite(led_pin, LOW);
  Serial.println("-----");
  for(int i=0;i<11;i++) { //Analisando
    Serial.println(data[i]);
    if(data[i] > bin_1) { //É 1?
      data[i] = 1;
    } else {
      if(data[i] > bin_0) {//É 0?
        data[i] = 0;
      }
    }
  }
  for(int i=0;i<11;i++) { //Checar se há dados com erros
    if(data[i] > 1) {
      return -1; //Retorna 1 se os dados forem errados
    }
  }
  int result = 0;
  int seed = 1;                          
  for(int i=0;i<11;i++) { //Convert bits em numero inteiro
    if(data[i] == 1) {
      result += seed;
    }
    seed = seed * 2;
  }
  return result; //Retorna o numero do botão precionado
}
