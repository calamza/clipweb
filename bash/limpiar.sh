## Borrar los clips a los 10 dias de su creacion
find cortos/ -mmin +14400 -type f -delete

## Borrar los videos originales a las 2 horas de su creacion
find download/ -mmin +14400 -type f -delete