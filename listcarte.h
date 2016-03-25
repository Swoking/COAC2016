#ifndef LISTCARTE_H
#define LISTCARTE_H

#include "mylist.h"

class MyList;

class ListCarte : public MyList
{

protected:
    virtual void showList();

public:
    ListCarte(COAC *parentFenetre, Database *database);
};

#endif // LISTCARTE_H
