#ifndef LIST_H
#define LIST_H

#include "ui_list.h"
#include "coac.h"
#include "database.h"
#include "QWidget"

class Database;
class COAC;

class MyList : public QDialog, private Ui::List
{
    Q_OBJECT
protected:
    Database *db;
    COAC *fen;

    virtual void showList() = 0;

public:
    MyList(COAC *parentFenetre, Database *database, QWidget *parent = 0);
};

#endif // LIST_H
