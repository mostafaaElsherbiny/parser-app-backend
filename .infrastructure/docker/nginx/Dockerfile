FROM nginx:alpine

ARG env

COPY .infrastructure/docker/nginx/nginx.conf /etc/nginx/nginx.conf
RUN rm /etc/nginx/conf.d/default.conf
COPY .infrastructure/docker/nginx/conf.d/${env}/ /etc/nginx/conf.d/

WORKDIR "/application"

COPY . .

CMD ["nginx", "-g", "daemon off;"]