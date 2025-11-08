FROM node:20

# Cria diretório de trabalho
WORKDIR /app

RUN apt-get update && apt-get install -y python3 g++ make && rm -rf /var/lib/apt/lists/*

# Copia apenas package.json e lock para instalar dependências primeiro (cache melhor)
COPY package*.json ./

# Instala as dependências
RUN npm install --ignore-scripts

# Copia o restante da aplicação
COPY . .

# Expõe porta do Vite
EXPOSE 5173

# Comando padrão (pode ser sobrescrito)
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]