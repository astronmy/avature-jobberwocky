FROM node:14-alpine

WORKDIR /usr/src/app

RUN apk add --no-cache git && \
    git clone https://github.com/avatureta/jobberwocky-extra-source-v2.git .

COPY package*.json ./

RUN npm install

COPY . .

# Exponer el puerto donde corre la aplicación
EXPOSE 8080

# Comando para iniciar el servicio
CMD [ "node", "app.js" ]
