#ifndef DATABASE_H
#define DATABASE_H

#include <QtSql>


class Database
{

private:
    QString host;
    QString user;
    QString pass;
    QString baseName;
    QSqlDatabase db;

public:
    Database();
    ~Database();
    QSqlDatabase getDB();
};

#endif // DATABASE_H
