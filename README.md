##Environnement d'exécution : Windows/Linux

##installation des packages (node modules)
##Partie client

cd restaurant\client\ && npm install
cd ..\server\ && npm install 

##Démarrage des serveurs; JSON, Node et React respectivement. 

json-server --watch restaurant\data\panier.json --port 8888
nodemon restaurant\server\index.js
npm run start restaurant\client\

##Partie administrateur
1 - Création d'un virtual host dont le dossier racine (root) est "restaurant\"
2 - Importation de la base de données sous le nom de "restaurant" se trouvant dans le dossier "restaurant\data"