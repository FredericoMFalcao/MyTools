#include <stdio.h>
#include <string.h>

#define TRUE 1
#define FALSE 0

#define streq(a,b) (strcmp(a,b) == 0)

#include "tests/tests.c"

int isArgOption(char *opt,int argc,char ** argv) {
	for(int i=0;i<argc;i++)
		if (streq(argv[i],opt)) return TRUE;
	return FALSE;
}


int lineNo;

int main(int argc, char**argv) {

	char c;

	if (isArgOption("--self-test", argc, argv)) {return allTests();}

	/* 1.0 Main Loop to parse content */
	while(!feof(stdin) && ( c = fgetc(stdin))) {
		#include "modules/01_count_lines-didReadChar.c"
	}

	#include "modules/01_count_lines-willDie.c"

	return 0;
}
