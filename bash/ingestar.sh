## obtener token de login

token=$(curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/login' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: DLI8V9b38r1v2LC4ZtfIBAWlYST6XKkZfoK9glJHkJSiKccYH4cqjM7T5hPszdgB' -F 'username=jtassi' -F 'password=Santino2015' | awk -F ":" '{print $4}' | awk -F "}" '{print $1}' | sed -e 's|["'\'']||g')
echo $token
## listar archivos disponibles para subir
for i in *.mp4
do 
    echo "hello $i"

done


curl -k -X 'POST' 'https://mediacms.unomedios.com.ar/api/v1/media' -H 'accept: application/json' -H 'Content-Type: multipart/form-data' -H 'X-CSRFToken: eNygsmd2IqsUthGLr1mIp7WeLu0WknvvVQ3zKdYJwNmodchsZhLD9xXJAeWGqYYE' --header 'Authorization: Basic anRhc3NpOlNhbnRpbm8yMDE1' -F 'media_file=@video.mp4;type=video/mp4' -F 'description=PruebaAPI' -F 'title=DesdeLaApi'