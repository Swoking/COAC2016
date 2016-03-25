#ifndef LISTELEVE_H
#define LISTELEVE_H

#include "mylist.h"
#include <QStandardItemModel>

class Database;
class COAC;
class MyList;
class AddCarte;

class ListEleve : public MyList
{
protected:
    virtual void showList();

public:
    ListEleve(COAC *parentFenetre, Database *database);
    ListEleve(AddCarte *parentFenetre, Database *database);
};

#endif // LISTELEVE_H
