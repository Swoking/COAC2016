#ifndef DATABASE_H
#define DATABASE_H

#include <QtSql>


class Database
{
private:
    QSqlDatabase db;

public:
    QString host;
    QString user;
    QString pass;
    QString database;
    Database();
    ~Database();
    QSqlDatabase getDB();
    void connect();
};

#endif // DATABASE_H
