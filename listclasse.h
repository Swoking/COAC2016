#ifndef LISTCLASSE_H
#define LISTCLASSE_H

#include "mylist.h"

class Database;
class COAC;
class MyList;

class ListClasse : public MyList
{

protected:
    virtual void showList();

public:
    ListClasse(COAC *parentFenetre, Database *database);
};

#endif // LISTCLASSE_H
