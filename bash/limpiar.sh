## Borrar los clips a los 30 dias de su creacion
find clips/ -mmin +43200 -type f -delete

## Borrar los clips de larga duracion a los 6 meses de su creacion
find clips/ -mmin +259200 -type f -delete

## Borrar los videos originales a las 2 horas de su creacion
find downloads/ -mmin +120 -type f -delete