## Borrar los clips a los 10 dias de su creacion
find clips/ -mmin +14400 -type f -delete

## Borrar los videos originales a las 2 horas de su creacion
find downloads/ -mmin +14400 -type f -delete