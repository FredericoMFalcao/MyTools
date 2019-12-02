SHELL=/bin/bash

compile: doc/global-variables.tex
	cd doc; pdflatex main.tex || true 
	#cd doc; pdflatex main.tex || true
	mv doc/main.pdf main.pdf
clean:
	rm doc/*.aux doc/*.log doc/*.out doc/*.pdf doc/global-variables.tex precompile.db

doc/global-variables.tex: precompile.db
	sqlite3 --separator '	' precompile.db 'SELECT name,type,description FROM globalVars' | doc/global-variables.tex.php > doc/global-variables.tex

precompile.db:
	echo > precompile.db # Clear the database
	sqlite3 precompile.db 'CREATE TABLE globalVars(type text , name text, description text, version text)'
	sqlite3 precompile.db 'INSERT INTO globalVars(type,name,description,version)VALUES("int","i","this is a generic integer to be used globally on the code.","1.0")'
	sqlite3 precompile.db 'INSERT INTO globalVars(type,name,description,version)VALUES("int","j","this is a generic integer to be used globally on the code.","1.0")'
	sqlite3 precompile.db 'INSERT INTO globalVars(type,name,description,version)VALUES("char*","name","this is the name of the user.","1.0")'


