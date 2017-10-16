/*
 * 
 *
 * Created: 2/16/2016 12:16:40 AM
 *  Author: 
 */ 
#define F_CPU 16000000UL
#define baud 38400
#define baud_pre ((F_CPU/(baud*16))-1)

#include <avr/io.h>
#include <avr/interrupt.h>
#include <util/delay.h>


#define G_Port PORTA
#define DATA0 PINA0
#define DATA1 PINA1
#define DATA2 PINA2
#define DATA3 PINA3
#define DATA4 PINA4
#define DATA5 PINA5
#define DATA6 PINA6
#define DATA7 PINA7

#define G_HandshakeDDR DDRD
#define G_Handshake PORTD
#define DAV PIND3
#define NRFD PIND4
#define NDAC PIND5


uint8_t data =0;

void Interrupt_enable()
{
	MCUCR |= ((1<<ISC11));
	GICR |= ((1<<INT1));//int1 enable
	GIFR |= ((1<<INTF1));
	//G_HandshakeDDR &= ~(1<<DAV);
	//G_Handshake |= (1<<DAV);	
}

void uart_init()
{
	UBRRH=(baud_pre>>8);
	UBRRL=baud_pre;
	UCSRB |=(1<<TXEN) |(1<<RXEN);
	UCSRC |= (1<<URSEL) | (1<<UCSZ0) |(1<<UCSZ1);
}

void uart_write(uint8_t data)
{
	UDR = data;
	while(!(UCSRA &(1<<UDRE)));
}

int main(void)
{
	uart_init();	
	Interrupt_enable();
	G_HandshakeDDR |= ((1<<NRFD)|(1<<NDAC));
	//DDRA = 0x00;
	//G_Port = 0xff;
	
	sei();
	//G_Handshake &= ~(1<<NDAC);
	G_Handshake |= (1<<NRFD);
	
    while(1)
    {			
		;		
    }
}

ISR(INT1_vect)
{
	G_Handshake &= ~(1<<NRFD);
	G_Handshake |= (1<<NDAC);
	data = ~(PINA);
	uart_write(data);
	while (bit_is_clear(PIND,3));
	G_Handshake &= ~(1<<NDAC);
	G_Handshake |= (1<<NRFD);
}
