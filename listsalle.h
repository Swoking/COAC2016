#ifndef LISTSALLE_H
#define LISTSALLE_H

#include "mylist.h"

class Database;
class COAC;
class MyList;

class ListSalle : public MyList
{

protected:
    virtual void showList();

public:
    ListSalle(COAC *parentFenetre, Database *database);
};

#endif // LISTSALLE_H
