#ifndef ADDLYCEE_H
#define ADDLYCEE_H

#include "myadd.h"

class AddLycee : public MyAdd
{
    Q_OBJECT
private:
    QLineEdit *ledtNom;

protected slots:
    virtual void envoyer();

public:
    explicit AddLycee(COAC *, Database *);
};

#endif // ADDLYCEE_H
