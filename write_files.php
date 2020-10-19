BY HASSINI AYOUB


r 	Open a file for read only.
	File pointer starts at the beginning of the file

w 	Open a file for write only.
	Erases the contents of the file or creates a new file if it doesn't exist.
	File pointer starts at the beginning of the file

a 	Open a file for write only.
	The existing data in file is preserved.
	File pointer starts at the end of the file.
	Creates a new file if the file doesn't exist

x 	Creates a new file for write only.
	Returns FALSE and an error if file already exists

r+ 	Open a file for read/write.
	File pointer starts at the beginning of the file

w+ 	Open a file for read/write.
	Erases the contents of the file or creates a new file if it doesn't exist.
	File pointer starts at the beginning of the file

a+ 	Open a file for read/write.
	The existing data in file is preserved.
	File pointer starts at the end of the file.
	Creates a new file if the file doesn't exist

x+ 	Creates a new file for read/write.
	Returns FALSE and an error if file already exists



$typeofwrite = r, w, a, x, r+, w+, a+, x+;


fopen($filename, $typeofwrite) or die("Unable to open file!");

fread($fopen_func, filesize($filename));


fwrite($fopen_func, $text);

fclose($fopen_func);

file_put_contents($filename, $text)
