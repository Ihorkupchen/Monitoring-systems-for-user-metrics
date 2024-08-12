# Dockerfile
FROM php:8.1-cli

RUN apt-get update && apt-get install -y cron

COPY crontab.txt /etc/cron.d/my-cron-job

RUN chmod 0644 /etc/cron.d/my-cron-job

RUN crontab /etc/cron.d/my-cron-job

CMD ["cron", "-f"]