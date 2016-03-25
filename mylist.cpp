#include "mylist.h"

MyList::MyList(COAC *parentFenetre, Database *database, QWidget *parent) :
    QDialog(parent),
    db(database),
    fen(parentFenetre)
{
    setupUi(this);
    myTreeList = treeList;
}

MyList::MyList(AddCarte *parentFenetre, Database *database, QWidget *parent) :
    QDialog(parent),
    db(database),
    fenAddCarte(parentFenetre)
{
    setupUi(this);
    myTreeList = treeList;
}
