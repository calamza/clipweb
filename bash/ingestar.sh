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
rm destino.txt origen.txt


## listar archivos disponibles para subir

for j in $destinationfolder/*.mp4
do
        ## Generar listado de archivos de destino
        echo $j | awk -F "." '{ print $3}' >> destino.txt
done


for i in $originfolder/*.mp4
do
        echo $i | awk -F "/" '{ print $6}' | awk -F "." '{ print $1 }' | sed -r 's/[ ]/_/g' >> origen.txt

done
sort destino.txt > destino2.txt
rm destino.txt
mv destino2.txt destino.txt
sort origen.txt > origen2.txt
rm origen.txt
mv origen2.txt origen.txt
comm -23 origen.txt destino.txt > to_run.txt
nombre_archivo="to_run.txt"
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


## Ingestar master de radios

## Basic login authoration con usuario mediacms
usuario="QXllckNNUzpNZWRpb3MyMDI0ISE="

## Carpetas de origen y destino donde estan o van los mp4
originfolder="/mnt/masters/Ayer"
destinationfolder="/home/mediacms.io/mediacms/media_files/original/user/AyerCMS"

## Carpeta de trabajo donde esta el ingesta.sh
workdir="/root"
cd $workdir

## limpiamos los archivos de origen
rm destino.txt origen.txt

## listar archivos disponibles para subir

for j in $destinationfolder/*.mp3
do
        ## Generar listado de archivos de destino
        echo $j | awk -F "." '{ print $3}' >> destino.txt
done


for i in $originfolder/*.mp3
do
        echo $i | awk -F "/" '{ print $5}' | awk -F "." '{ print $1 }' | sed -r 's/[ ]/_/g' >> origen.txt
done
sort destino.txt > destino2.txt
rm destino.txt
mv destino2.txt destino.txt
sort origen.txt > origen2.txt
rm origen.txt
mv origen2.txt origen.txt
comm -23 origen.txt destino.txt > to_run.txt
nombre_archivo="to_run.txt"

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
            curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/media' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: eNygsmd2IqsUthGLr1mIp7WeLu0WknvvVQ3zKdYJwNmodchsZhLD9xXJAeWGqYYE' --header 'Authorization: Basic '"$usuario" -F 'media_file=@'"$filename" -F 'description=Desde el local con el hosts cambiado' -F 'title='"$lineaEditada"
          else
            echo $filename" es mas grande de lo soportado"
          fi
        else
          echo $filename" es menor a lo esperado"

        fi

done < "$nombre_archivo"