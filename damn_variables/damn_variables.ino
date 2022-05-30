#include <SoftwareSerial.h>                    //introduire la librairie
#include <Wire.h>                              //introduire la seconde librairie



SoftwareSerial gofypd(7, 8);                   //déclarer le port du module bluetooth
char symbole_transmis;                                       //déclarer variable qui stocke les messages reçues 
const int relayPin =  6;                       //le relais est connecté en D6
const int input_voltage  = 14;//V
const int nominal_voltage  = 18;////V
const int MAX_SPEED  = int(nominal_voltage * 255 / input_voltage);


const int directionA  = 12;
const int directionB  = 13; 

const int brakeA  = 9;
const int brakeB  = 8;

const int speedA  = 3;
const int speedB  = 11;

const int in2  = A2;
const int in3  = A3;


int distance_in_cm = 0;
char cstr[16];

void setup(){                                  //définir la fonction setup
  Serial.println(F("Initialize System"));
  gofypd.begin(9600);                          //déclare le débit de communication
  Serial.begin(9600); 
  pinMode(relayPin, OUTPUT);                    
  pinMode(4, OUTPUT);                          //la led est connecté en D4
  pinMode(directionA, OUTPUT); //Initiates Motor Channel A pin
  pinMode(brakeA, OUTPUT); //Initiates Brake Channel A pin
  pinMode(directionB, OUTPUT); //Initiates Motor Channel B pin
  pinMode(brakeB, OUTPUT); //Initiates Brake Channel B pin
}

void loop(){
  distance_in_cm = 0.01723 * readUltrasonicDistance(A2, A2);
  gofypd.write(itoa(distance_in_cm, cstr, 10));
  Serial.print(itoa(distance_in_cm, cstr, 10));
  Serial.print("Distance : ");
  Serial.print(distance_in_cm);
  Serial.println("cm");

  delay(1000); // Wait for 100 millisecond(s)
  
  digitalWrite(4, LOW);                        //met un niveau logique bas
  Serial.println(symbole_transmis);
  if (gofypd.available()){   
    delay(1000); // Wait for 100 millisecond(s)                 
    if(symbole_transmis != gofypd.read()){symbole_transmis = gofypd.read();}                     
  }

  if(checkDistance(distance_in_cm)){dcStop();}
  else{mooveViaInstruction(symbole_transmis);}
}

/*
 * 
 * GPS position
Chaque utilisation : temps, heure et date de début, heure et date de fin, quels mouvements
Batterie
Les éventuelles erreurs
Nombre d'appels
Capteurs de proximité : valeur max qu'ils ont enregistré, valeur moyenne, valeur min

 */






   
