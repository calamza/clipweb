## Ingestar videos de canal7

## obtener token de login

#token=$(curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/login' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: DLI8V9b38r1v2LC4ZtfIBAWlYST6XKkZfoK9glJHkJSiKccYH4cqjM7T5hPszdgB' -F 'username=jtassi' -F 'password=Santino2015' | awk -F ":" '{print $4}' | awk -F "}" '{print $1}' | sed -e 's|["'\'']||g')
#echo $token

## Basic login authoration con usuario mediacms
usuario="TWVkaWFDTVM6TGczNjgxTGc="

## Carpetas de origen y destino donde estan o van los mp4
originfolder="/home/mediacms.io/mediacms/squid"
destinationfolder="/home/mediacms.io/mediacms/media_files/original/user/MediaCMS"

## Carpeta de trabajo donde esta el ingesta.sh
workdir="/root"
cd $workdir

## limpiamos los archivos de origen
rm $workdir/destino.txt $workdir/origen.txt

## listar archivos disponibles para subir

for j in $destinationfolder/*.mp4
do
        ## Generar listado de archivos de destino
        echo $j | awk -F "." '{ print $3}' >> $workdir/destino.txt
done


for i in $originfolder/*.mp4
do
        echo $i | awk -F "/" '{ print $6}' | awk -F "." '{ print $1 }' | sed -r 's/[ ]/_/g' >> $workdir/origen.txt

done
sort $workdir/destino.txt > $workdir/destino2.txt
rm $workdir/destino.txt
mv $workdir/destino2.txt $workdir/destino.txt
sort $workdir/origen.txt > $workdir/origen2.txt
rm $workdir/origen.txt
mv $workdir/origen2.txt $workdir/origen.txt
comm -23 $workdir/origen.txt $workdir/destino.txt > $workdir/to_run.txt
nombre_archivo="$workdir/to_run.txt"
while read -r line
do
        lineaEditada=$(echo $line | sed -r 's/[_]/ /g')
        filename=$originfolder"/"$lineaEditada".mp4"
        filesize=$(stat -c%s "$filename")
        minsize=50000
        maxsize=4000000000
        if [ $filesize -gt $minsize ]
        then
          if [ $filesize -lt $maxsize ]
          then
            echo $filename" esta ok"
            curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/media' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: eNygsmd2IqsUthGLr1mIp7WeLu0WknvvVQ3zKdYJwNmodchsZhLD9xXJAeWGqYYE' --header 'Authorization: Basic '"$usuario" -F 'media_file=@'"$filename"';type=video/mp4' -F 'description=Desde el local con el hosts cambiado' -F 'title='"$lineaEditada"
          else
            echo $filename" es mas grande de lo soportado"
          fi
        else
          echo $filename" es menor a lo esperado"

        fi

done < "$nombre_archivo"


## Ingestar master de radio ayer

## Basic login authoration con usuario ayercms
usuario="QXllckNNUzpsZzM2ODFsZw=="

## Carpetas de origen y destino donde estan o van los mp4
originfolder="/mnt/masters/Ayer"
destinationfolder="/home/mediacms.io/mediacms/media_files/original/user/AyerCMS"

## Carpeta de trabajo donde esta el ingesta.sh
workdir="/root"
cd $workdir

## limpiamos los archivos de origen
rm $workdir/destino.txt $workdir/origen.txt

## listar archivos disponibles para subir

for j in $destinationfolder/*.mp3
do
        ## Generar listado de archivos de destino
        echo $j | awk -F "." '{ print $3}' >> $workdir/destino.txt
done


for i in $originfolder/*.mp3
do
        echo $i | awk -F "/" '{ print $5}' | awk -F "." '{ print $1 }' | sed -r 's/[ ]/_/g' >> $workdir/origen.txt
done
sort $workdir/destino.txt > $workdir/destino2.txt
rm $workdir/destino.txt
mv $workdir/destino2.txt $workdir/destino.txt
sort $workdir/origen.txt > $workdir/origen2.txt
rm $workdir/origen.txt
mv $workdir/origen2.txt $workdir/origen.txt
comm -23 $workdir/origen.txt $workdir/destino.txt > $workdir/to_run.txt
nombre_archivo="$workdir/to_run.txt"

## Ingesta los contenidos
while read -r line
do
        lineaEditada=$(echo $line | sed -r 's/[_]/ /g')
        filename=$originfolder"/"$lineaEditada".mp3"
        filesize=$(stat -c%s "$filename")
        minsize=300
        maxsize=400000000
        if [ $filesize -gt $minsize ]
        then
          if [ $filesize -lt $maxsize ]
          then
            echo $filename" esta ok"
            curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/media' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: zf4VNYyRfG2fSXgKbedJSsevnkJJYHjemtCDenzi8zflFIIxqySthe1k9JSeNm7o' --header 'Authorization: Basic '"$usuario" -F 'media_file=@'"$filename" -F 'description=Desde el local con el hosts cambiado' -F 'title='"$lineaEditada"
          else
            echo $filename" es mas grande de lo soportado"
          fi
        else
          echo $filename" es menor a lo esperado"

        fi

done < "$nombre_archivo"

## Ingestar master de radios brava

## Basic login authoration con usuario mediacms
usuario="QnJhdmFDTVM6TWVkaW9zMjQyNA=="

## Carpetas de origen y destino donde estan o van los mp4
originfolder="/mnt/masters/Brava"
destinationfolder="/home/mediacms.io/mediacms/media_files/original/user/BravaCMS"

## Carpeta de trabajo donde esta el ingesta.sh
workdir="/root"
cd $workdir

## limpiamos los archivos de origen
rm $workdir/destino.txt $workdir/origen.txt

## listar archivos disponibles para subir

for j in $destinationfolder/*.mp3
do
        ## Generar listado de archivos de destino
        echo $j | awk -F "." '{ print $3}' >> $workdir/destino.txt
done


for i in $originfolder/*.mp3
do
        echo $i | awk -F "/" '{ print $5}' | awk -F "." '{ print $1 }' | sed -r 's/[ ]/_/g' >> $workdir/origen.txt
done
sort $workdir/destino.txt > $workdir/destino2.txt
rm $workdir/destino.txt
mv $workdir/destino2.txt $workdir/destino.txt
sort $workdir/origen.txt > $workdir/origen2.txt
rm $workdir/origen.txt
mv $workdir/origen2.txt $workdir/origen.txt
comm -23 $workdir/origen.txt $workdir/destino.txt > $workdir/to_run.txt
nombre_archivo="$workdir/to_run.txt"

## Ingesta los contenidos
while read -r line
do
        lineaEditada=$(echo $line | sed -r 's/[_]/ /g')
        filename=$originfolder"/"$lineaEditada".mp3"
        filesize=$(stat -c%s "$filename")
        minsize=300
        maxsize=400000000
        if [ $filesize -gt $minsize ]
        then
          if [ $filesize -lt $maxsize ]
          then
            echo $filename" esta ok"
            curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/media' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: rdPyHsbZ7AgNBHU2XWMPzls70j4cOE1Eerng8Rcq0ttTosmPcgrzY7fWMIdHDjPO' --header 'Authorization: Basic '"$usuario" -F 'media_file=@'"$filename" -F 'description=Desde el local con el hosts cambiado' -F 'title='"$lineaEditada"
          else
            echo $filename" es mas grande de lo soportado"
          fi
        else
          echo $filename" es menor a lo esperado"

        fi

done < "$nombre_archivo"

## Ingestar master de radio montecristo

## Basic login authoration con usuario mediacms
usuario="TW9udGVDTVM6TWVkaW9zMjQyNA=="

## Carpetas de origen y destino donde estan o van los mp4
originfolder="/mnt/masters/Montecristo"
destinationfolder="/home/mediacms.io/mediacms/media_files/original/user/MonteCMS"

## Carpeta de trabajo donde esta el ingesta.sh
workdir="/root"
cd $workdir

## limpiamos los archivos de origen
rm $workdir/destino.txt $workdir/origen.txt

## listar archivos disponibles para subir

for j in $destinationfolder/*.mp3
do
        ## Generar listado de archivos de destino
        echo $j | awk -F "." '{ print $3}' >> $workdir/destino.txt
done


for i in $originfolder/*.mp3
do
        echo $i | awk -F "/" '{ print $5}' | awk -F "." '{ print $1 }' | sed -r 's/[ ]/_/g' >> $workdir/origen.txt
done
sort $workdir/destino.txt > $workdir/destino2.txt
rm $workdir/destino.txt
mv $workdir/destino2.txt $workdir/destino.txt
sort $workdir/origen.txt > $workdir/origen2.txt
rm $workdir/origen.txt
mv $workdir/origen2.txt $workdir/origen.txt
comm -23 $workdir/origen.txt $workdir/destino.txt > $workdir/to_run.txt
nombre_archivo="$workdir/to_run.txt"

## Ingesta los contenidos
while read -r line
do
        lineaEditada=$(echo $line | sed -r 's/[_]/ /g')
        filename=$originfolder"/"$lineaEditada".mp3"
        filesize=$(stat -c%s "$filename")
        minsize=300
        maxsize=400000000
        if [ $filesize -gt $minsize ]
        then
          if [ $filesize -lt $maxsize ]
          then
            echo $filename" esta ok"
            curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/media' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: HuEtQiQa7xszR7ccUF4Rh3Dngyz0MCD7uIcbhHRB0qFFESEZ9ZJBGPqc2XIvBhrh' --header 'Authorization: Basic '"$usuario" -F 'media_file=@'"$filename" -F 'description=Desde el local con el hosts cambiado' -F 'title='"$lineaEditada"
          else
            echo $filename" es mas grande de lo soportado"
          fi
        else
          echo $filename" es menor a lo esperado"

        fi

done < "$nombre_archivo"

## Ingestar master de radio una

## Basic login authoration con usuario unacms
usuario="VW5hQ01TOk1lZGlvczI0MjQ="

## Carpetas de origen y destino donde estan o van los mp4
originfolder="/mnt/masters/Una"
destinationfolder="/home/mediacms.io/mediacms/media_files/original/user/UnaCMS"

## Carpeta de trabajo donde esta el ingesta.sh
workdir="/root"
cd $workdir

## limpiamos los archivos de origen
rm $workdir/destino.txt $workdir/origen.txt

## listar archivos disponibles para subir

for j in $destinationfolder/*.mp3
do
        ## Generar listado de archivos de destino
        echo $j | awk -F "." '{ print $3}' >> $workdir/destino.txt
done


for i in $originfolder/*.mp3
do
        echo $i | awk -F "/" '{ print $5}' | awk -F "." '{ print $1 }' | sed -r 's/[ ]/_/g' >> $workdir/origen.txt
done
sort $workdir/destino.txt > $workdir/destino2.txt
rm $workdir/destino.txt
mv $workdir/destino2.txt $workdir/destino.txt
sort $workdir/origen.txt > $workdir/origen2.txt
rm $workdir/origen.txt
mv $workdir/origen2.txt $workdir/origen.txt
comm -23 $workdir/origen.txt $workdir/destino.txt > $workdir/to_run.txt
nombre_archivo="$workdir/to_run.txt"

## Ingesta los contenidos
while read -r line
do
        lineaEditada=$(echo $line | sed -r 's/[_]/ /g')
        filename=$originfolder"/"$lineaEditada".mp3"
        filesize=$(stat -c%s "$filename")
        minsize=300
        maxsize=400000000
        if [ $filesize -gt $minsize ]
        then
          if [ $filesize -lt $maxsize ]
          then
            echo $filename" esta ok"
            curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/media' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: zf4VNYyRfG2fSXgKbedJSsevnkJJYHjemtCDenzi8zflFIIxqySthe1k9JSeNm7o' --header 'Authorization: Basic '"$usuario" -F 'media_file=@'"$filename" -F 'description=Desde el local con el hosts cambiado' -F 'title='"$lineaEditada"
          else
            echo $filename" es mas grande de lo soportado"
          fi
        else
          echo $filename" es menor a lo esperado"

        fi

done < "$nombre_archivo"

## Ingestar master de radio La Red

## Basic login authoration con usuario laredcms
usuario="TGFyZWRDTVM6TWVkaW9zMjQyNA=="

## Carpetas de origen y destino donde estan o van los mp4
originfolder="/mnt/masters/LaRed"
destinationfolder="/home/mediacms.io/mediacms/media_files/original/user/LaredCMS"

## Carpeta de trabajo donde esta el ingesta.sh
workdir="/root"
cd $workdir

## limpiamos los archivos de origen
rm $workdir/destino.txt $workdir/origen.txt

## listar archivos disponibles para subir

for j in $destinationfolder/*.mp3
do
        ## Generar listado de archivos de destino
        echo $j | awk -F "." '{ print $3}' >> $workdir/destino.txt
done


for i in $originfolder/*.mp3
do
        echo $i | awk -F "/" '{ print $5}' | awk -F "." '{ print $1 }' | sed -r 's/[ ]/_/g' >> $workdir/origen.txt
done
sort $workdir/destino.txt > $workdir/destino2.txt
rm $workdir/destino.txt
mv $workdir/destino2.txt $workdir/destino.txt
sort $workdir/origen.txt > $workdir/origen2.txt
rm $workdir/origen.txt
mv $workdir/origen2.txt $workdir/origen.txt
comm -23 $workdir/origen.txt $workdir/destino.txt > $workdir/to_run.txt
nombre_archivo="$workdir/to_run.txt"

## Ingesta los contenidos
while read -r line
do
        lineaEditada=$(echo $line | sed -r 's/[_]/ /g')
        filename=$originfolder"/"$lineaEditada".mp3"
        filesize=$(stat -c%s "$filename")
        minsize=300
        maxsize=400000000
        if [ $filesize -gt $minsize ]
        then
          if [ $filesize -lt $maxsize ]
          then
            echo $filename" esta ok"
            curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/media' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: waMjwWraHMixfWytplJfbNAo14VtRgChjok1XlsBAFvD2H0gEFoZAzndNt4YGVqr' --header 'Authorization: Basic '"$usuario" -F 'media_file=@'"$filename" -F 'description=Desde el local con el hosts cambiado' -F 'title='"$lineaEditada"
          else
            echo $filename" es mas grande de lo soportado"
          fi
        else
          echo $filename" es menor a lo esperado"

        fi

done < "$nombre_archivo"

## Ingestar master de radio Nihuil

## Basic login authoration con usuario nihuilcms
usuario="TmlodWlsQ01TOk1lZGlvczI0MjQ="

## Carpetas de origen y destino donde estan o van los mp4
originfolder="/mnt/masters/NihuilFM"
destinationfolder="/home/mediacms.io/mediacms/media_files/original/user/NihuilCMS"

## Carpeta de trabajo donde esta el ingesta.sh
workdir="/root"
cd $workdir

## limpiamos los archivos de origen
rm $workdir/destino.txt $workdir/origen.txt

## listar archivos disponibles para subir

for j in $destinationfolder/*.mp3
do
        ## Generar listado de archivos de destino
        echo $j | awk -F "." '{ print $3}' >> $workdir/destino.txt
done


for i in $originfolder/*.mp3
do
        echo $i | awk -F "/" '{ print $5}' | awk -F "." '{ print $1 }' | sed -r 's/[ ]/_/g' >> $workdir/origen.txt
done
sort $workdir/destino.txt > $workdir/destino2.txt
rm $workdir/destino.txt
mv $workdir/destino2.txt $workdir/destino.txt
sort $workdir/origen.txt > $workdir/origen2.txt
rm $workdir/origen.txt
mv $workdir/origen2.txt $workdir/origen.txt
comm -23 $workdir/origen.txt $workdir/destino.txt > $workdir/to_run.txt
nombre_archivo="$workdir/to_run.txt"

## Ingesta los contenidos
while read -r line
do
        lineaEditada=$(echo $line | sed -r 's/[_]/ /g')
        filename=$originfolder"/"$lineaEditada".mp3"
        filesize=$(stat -c%s "$filename")
        minsize=300
        maxsize=400000000
        if [ $filesize -gt $minsize ]
        then
          if [ $filesize -lt $maxsize ]
          then
            echo $filename" esta ok"
            curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/media' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: X0U2mv5mSNksh8IFZyaNBMxZzeqC6oEGKesKNU6NLGxy4TaseSPx0ykOlDz7V3sQ' --header 'Authorization: Basic '"$usuario" -F 'media_file=@'"$filename" -F 'description=Desde el local con el hosts cambiado' -F 'title='"$lineaEditada"
          else
            echo $filename" es mas grande de lo soportado"
          fi
        else
          echo $filename" es menor a lo esperado"

        fi

done < "$nombre_archivo"

## Ingestar master de radio Latinos

## Basic login authoration con usuario latinoscms
usuario="TGF0aW5vc0NNUzpNZWRpb3MyNDI0"

## Carpetas de origen y destino donde estan o van los mp4
originfolder="/mnt/masters/Latinos"
destinationfolder="/home/mediacms.io/mediacms/media_files/original/user/LatinosCMS"

## Carpeta de trabajo donde esta el ingesta.sh
workdir="/root"
cd $workdir

## limpiamos los archivos de origen
rm $workdir/destino.txt $workdir/origen.txt

## listar archivos disponibles para subir

for j in $destinationfolder/*.mp3
do
        ## Generar listado de archivos de destino
        echo $j | awk -F "." '{ print $3}' >> $workdir/destino.txt
done


for i in $originfolder/*.mp3
do
        echo $i | awk -F "/" '{ print $5}' | awk -F "." '{ print $1 }' | sed -r 's/[ ]/_/g' >> $workdir/origen.txt
done
sort $workdir/destino.txt > $workdir/destino2.txt
rm $workdir/destino.txt
mv $workdir/destino2.txt $workdir/destino.txt
sort $workdir/origen.txt > $workdir/origen2.txt
rm $workdir/origen.txt
mv $workdir/origen2.txt $workdir/origen.txt
comm -23 $workdir/origen.txt $workdir/destino.txt > $workdir/to_run.txt
nombre_archivo="$workdir/to_run.txt"

## Ingesta los contenidos
while read -r line
do
        lineaEditada=$(echo $line | sed -r 's/[_]/ /g')
        filename=$originfolder"/"$lineaEditada".mp3"
        filesize=$(stat -c%s "$filename")
        minsize=300
        maxsize=400000000
        if [ $filesize -gt $minsize ]
        then
          if [ $filesize -lt $maxsize ]
          then
            echo $filename" esta ok"
            curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/media' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: G9VY7w6qWVUB7OlRqEbrNr93jp9xwAZJtntGyV7RPO7HUzNEFYQbcdWS5Oi2lfNT' --header 'Authorization: Basic '"$usuario" -F 'media_file=@'"$filename" -F 'description=Desde el local con el hosts cambiado' -F 'title='"$lineaEditada"
          else
            echo $filename" es mas grande de lo soportado"
          fi
        else
          echo $filename" es menor a lo esperado"

        fi

done < "$nombre_archivo"
