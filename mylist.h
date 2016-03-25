#ifndef MYLIST_H
#define MYLIST_H

#include "ui_mylist.h"

class COAC;
class Database;
class AddCarte;

class MyList : public QDialog, private Ui::MyList
{
    Q_OBJECT
protected:
    Database *db;
    COAC *fen;
    AddCarte *fenAddCarte;
    QTreeView *myTreeList;

    virtual void showList() = 0;

public:
    MyList(COAC *parentFenetre, Database *database, QWidget *parent = 0);
    MyList(AddCarte *parentFenetre, Database *database, QWidget *parent = 0);
};

#endif // MYLIST_H
