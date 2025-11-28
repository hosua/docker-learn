FROM archlinux:latest AS base

RUN pacman-key --init && \
    pacman-key --populate archlinux && \
    pacman -Sy --noconfirm archlinux-keyring && \
    pacman -Syu --noconfirm

WORKDIR /usr/local

RUN pacman -Syu --noconfirm npm

RUN useradd -m -d /home/endowed-user endowed-user
ENV HOME=/home/endowed-user

RUN mkdir -p /home/endowed-user
RUN pacman -Syu --noconfirm nodejs

USER endowed-user

# backend setup
FROM base AS backend
COPY --chown=endowed-user:endowed-user app/backend $HOME/backend
WORKDIR $HOME/backend
RUN touch /home/endowed-user/.node_repl_history
RUN npm i
CMD ["npm", "run", "dev"]


# frontend setup
FROM base AS frontend
COPY --chown=endowed-user:endowed-user app/frontend $HOME/frontend
WORKDIR $HOME/frontend
RUN npm i

EXPOSE 8080/tcp
CMD ["npm", "run", "dev"]
