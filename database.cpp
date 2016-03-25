#include "database.h"

Database::Database() :
    host("192.168.20.38"),
    user("root"),
    pass("root"),
    baseName("COAC2016")
{
    this->db = QSqlDatabase::addDatabase("QMYSQL");
    this->db.setHostName( this->host );
    this->db.setUserName( this->user );
    this->db.setPassword( this->pass );
    this->db.setDatabaseName( this->baseName );

    if( this->db.open() ) {
        qDebug() << "Database::Database() > Vous êtes maintenant connecté à " << db.hostName();
    } else {
        qDebug() << "Database::Database() > La connexion a échouée, désolé";
        qDebug() << db.lastError();
    }
}

Database::~Database(){
    this->db.close();

    qDebug() << "Database::~Database() > Vous êtes maintenant déconnecté de " << db.hostName();

}


QSqlDatabase Database::getDB(){
    return this->db;
}
