FROM node:15

RUN apt-get update && apt-get install yarn -y

WORKDIR /opt/app

COPY ./build/node/entrypoint.sh /home/app/entrypoint.sh

CMD /home/app/entrypoint.sh
