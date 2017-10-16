#define _CRT_SECURE_NO_DEPRECATE
#include <stdio.h>
#include <stdlib.h>
#include <math.h>
#include <Windows.h>
#include <conio.h>
#include <string.h>
int main()
{
	HANDLE hSerial;
	COMMTIMEOUTS timeouts = { 0 };
	int i = 0;
	int j = 0;
	int k = 0;
	DWORD dwCommEvent;
	DWORD dwRead;
	char  chRead;
	char data[45000];

	FILE *pfile = NULL;
	char *filename = "myfile.txt";

	pfile = fopen(filename, "w+");
	if (pfile == NULL)
	{
		printf("Error opening %s for writing. Program terminated.", filename);
	}

	DCB dcb = { 0 };
	dcb.DCBlength = sizeof(DCB);
	hSerial = CreateFile("COM3", GENERIC_READ | GENERIC_WRITE, 0, 0, OPEN_EXISTING, FILE_ATTRIBUTE_NORMAL, 0);
	if (hSerial == INVALID_HANDLE_VALUE)
	{
		if (GetLastError() == ERROR_FILE_NOT_FOUND)
			printf("ERROR creating file\n");
		printf("ERROR creating file Other");
		//return 1;
	}
	if (!GetCommState(hSerial, &dcb))
		printf("Error getting state\n");

	dcb.BaudRate = CBR_9600;
	dcb.Parity = NOPARITY;
	dcb.fParity = 0;
	dcb.StopBits = ONESTOPBIT;
	dcb.ByteSize = 8;

	if (!SetCommState(hSerial, &dcb))
		printf("error setting comm state");
	
	if (!SetCommMask(hSerial, EV_RXCHAR))
	{
		printf("Error setting communication event mask");
	}

	for (;;) {
		if (WaitCommEvent(hSerial, &dwCommEvent, NULL)) {
			do {
				if (ReadFile(hSerial, &chRead, 1, &dwRead, NULL))
				{
					//data[++i] = chRead;
					fputc(chRead, pfile);
					printf("%d", chRead);
					i++;
					if (i >= 45)
						break;
				}
				else
				// An error occurred in the ReadFile call.
				break;
			} while (dwRead);
		}
		else
			// Error in WaitCommEvent
			break;
		if (i == 45)
			break;
		
	}
	fclose(pfile);
	while (1);
}