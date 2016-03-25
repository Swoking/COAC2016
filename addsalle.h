#ifndef ADDSALLE_H
#define ADDSALLE_H

#include "myadd.h"

class AddSalle : public MyAdd
{
    Q_OBJECT
private:
    QLineEdit *ledtNom;

protected slots:
    virtual void envoyer();

public:
    explicit AddSalle(COAC *, Database *);
};

#endif // ADDSALLE_H
