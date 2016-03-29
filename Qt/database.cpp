#include "database.h"

Database::Database() :
    host("127.0.0.1"),
    user("root"),
    pass("root"),
    database("COAC2016")
{
    this->db = QSqlDatabase::addDatabase("QMYSQL");
    this->db.setHostName( this->host );
    this->db.setUserName( this->user );
    this->db.setPassword( this->pass );
    this->db.setDatabaseName( this->database );

    connect();
}

Database::~Database() {
    this->db.close();
    qDebug() << "Vous êtes maintenant déconnecté de " << db.hostName();
}

QSqlDatabase Database::getDB() {
    return this->db;
}

void Database::connect() {
    if(this->db.open()) {
        qDebug() << "Vous êtes maintenant connecté à " << db.hostName();
    } else {
        qDebug() << "La connexion a échouée, désolé";
        qDebug() << db.lastError();
    }
}
