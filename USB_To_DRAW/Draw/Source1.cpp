#include <GL/glut.h>
#include <math.h>
#include <Windows.h>
#include <iostream>
#include <fstream>
#include <stdlib.h>
#include <string>
//#include "matrix.h"

using namespace std;
int ww = 1000, wh = 700;

int x_int = 0;
int y_int = 0;
int z_int = 0;
int x_num[5000];
int x_cord1 = 485;
int y_cord1 = 171;
int x_cord2 = 475;
int y_cord2 = 171;
//int position[1500][30][2];
int ***position = new int **[5000];
double amplify = 1;
int mainWindow = 0;



void putPixel(int x, int y)
{
	glColor3f(1, 1, 1); // activate the pixel by setting the point color to white  
	glBegin(GL_POINTS);
	glVertex2i(x, y); // set the point  
	glEnd();
	//glFlush(); // process all openGL routines as quickly as possible  
}



void bresenhamAlg(int x0, int y0, int x1, int y1)
{
	int dx = abs(x1 - x0);
	int dy = abs(y1 - y0);
	int x, y;
	if (dx >= dy)
	{
		int d = 2 * dy - dx;
		int ds = 2 * dy;
		int dt = 2 * (dy - dx);
		if (x0 < x1)
		{
			x = x0;
			y = y0;
		}
		else
		{
			x = x1;
			y = y1;
			x1 = x0;
			y1 = y0;
		}
		putPixel(x, y);
		while (x < x1)
		{
			if (d < 0)
				d += ds;
			else {
				if (y < y1) {
					y++;
					d += dt;

				}
				else {
					y--;
					d += dt;

				}

			}
			x++;
			putPixel(x, y);
		}
	}
	else {
		int d = 2 * dx - dy;
		int ds = 2 * dx;
		int dt = 2 * (dx - dy);
		if (y0 < y1) {
			x = x0;
			y = y0;

		}
		else {
			x = x1;
			y = y1;
			y1 = y0;
			x1 = x0;

		}
		putPixel(x, y);
		while (y < y1)
		{
			if (d < 0)
				d += ds;
			else {
				if (x > x1){
					x--;
					d += dt;

				}
				else {
					x++;
					d += dt;

				}

			}
			y++;
			putPixel(x, y);
		}

	}
}
void plot()
{
	int k = 0;
	//bresenhamAlg(485, 171, 475, 171);
	for (int i = 0; i < z_int; i++)
	{
		for (int j = 0; j < x_num[i] - 1; j++)
		{
			k = j + 1;
			bresenhamAlg((position[i][j][0]*amplify)+200, (position[i][j][1]*amplify)+200, (position[i][k][0]*amplify)+200, (position[i][k][1]*amplify)+200);
			//putPixel(position[i][j][0], position[i][j][1]);

		}
	}
	/*x_cord1 = position[983][0][0];
	y_cord1 = position[983][0][1];
	x_cord2 = position[984][0][0];
	y_cord2 = position[984][0][1];
	cout << x_cord1 << y_cord1 << x_cord2 << y_cord2 << endl;*/
	//bresenhamAlg(x_cord1, y_cord1, x_cord2, y_cord2);
	//bresenhamAlg(position[983][0][0], position[983][0][1], position[984][0][0], position[984][0][1]);
}

void display()
{
	//bresenhamAlg(x_cord1, y_cord1, x_cord2, y_cord2);
	//cout << position[983][0][0] << position[983][0][1] << position[984][0][0] << position[984][0][1] << endl;
	//bresenhamAlg(position[983][0][0], position[983][0][1], position[984][0][0], position[984][0][1]);
	plot();
	glFlush();
}


void renderScene() {
	glutSetWindow(mainWindow);
	glClear(GL_COLOR_BUFFER_BIT);
	//glutSwapBuffers();
}

void myKeyboard(unsigned char  theKey, int x, int y)
{
	switch (theKey)
	{
	case 'l':
		amplify = amplify + 0.05;
		break;
	case 's':
		amplify = amplify - 0.05;
		break;
	case 'e':
		exit(-1);
		break;
	}
	//glFlush();
	glutSetWindow(mainWindow);
	glutPostRedisplay();
	renderScene();
}

void myinit()
{
	//glViewport(0, 0, ww, wh);
	//glMatrixMode(GL_PROJECTION);
	//glLoadIdentity();
	gluOrtho2D(0.0, (GLdouble)ww, 0.0, (GLdouble)wh);
	//glMatrixMode(GL_MODELVIEW);
}


int main(int argc, char** argv)
{
	streampos size;
	char * memblock;
	memblock = 0;
	string str = "";
	for (int i = 0; i<5000; i++)
		position[i] = new int *[150];

	for (int i = 0; i<5000; i++)
	for (int j = 0; j<150; j++)
		position[i][j] = new int[2];

	for (int i = 0; i < 5000; i++)
	for (int j = 0; j < 150; j++)
	{

		position[i][j][0] = 0;
		position[i][j][1] = 0;
	}

	UINT16 ii = 0;
	//int j = 0;

	ifstream file("tet.txt", ios::in | ios::binary | ios::ate);
	try{
		if (file.is_open())
		{
			size = file.tellg();
			memblock = new char[size];
			file.seekg(0, ios::beg);
			file.read(memblock, size);
			file.close();

			cout << "the entire file content is in memory" << size << endl;

		}
		else { cout << "Unable to open file"; }
		while (ii < size)
		{

			if (memblock[ii] == 'p')
			{
				++ii;
				if (memblock[ii] == 'u')
				{
					x_num[z_int] = x_int;
					z_int++;
					
					x_int = 0;
				}
				else if (memblock[ii] == 'a')
				{
					while (memblock[++ii] != ',')
					{
						str += memblock[ii];
					}
					position[z_int][x_int][0] = stoi(str);
					str = "";
					while (memblock[++ii] != ';')
					{
						str += memblock[ii];
					}
					position[z_int][x_int][1] = stoi(str);
					str = "";
					x_int++;
					++ii;
				}
			}
			else
			{
				ii++;
			}
		}
	}

	catch (...)
	{
		cout << "Error" << endl;
	}
	/*for (int i = 0; i < z_int; i++)
	{
		for (int j = 0; j < x_num[i]; j++)
		{
			cout << position[i][j][0] << "," << position[i][j][1] << "  ";
		}
		cout << endl;
	}
	cout << z_int << endl;
	cout << position[984][0][0] << position[984][0][1] << position[983][0][0] << position[983][0][1] << endl;
	*/
	
	glutInit(&argc, argv);
	glutInitDisplayMode(GLUT_SINGLE | GLUT_RGB);
	glutInitWindowSize(ww, wh);
	mainWindow=glutCreateWindow("Waveform");
	glutDisplayFunc(display);
	glutKeyboardFunc(myKeyboard);
	glutPositionWindow(0, 0);
	myinit();
	
	glutMainLoop();
	return 0;
}
