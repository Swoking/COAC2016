#ifndef LISTLOG_H
#define LISTLOG_H

#include "mylist.h"

class MyList;

class ListLog : public MyList
{

protected:
    virtual void showList();

public:
    ListLog(COAC *parentFenetre, Database *database);
};

#endif // LISTLOG_H
