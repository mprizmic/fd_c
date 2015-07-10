CON ESTE COMNADO importo datos del directorio

/var/lib/mysql/Fd/nombre_archivo.csv

load data infile "orientaciones.csv" 
into table media_orientaciones
fields terminated by ","
lines TERMINATED BY "\n"
(codigo, nombre, orden)


