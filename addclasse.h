#ifndef ADDCLASSE_H
#define ADDCLASSE_H

#include "myadd.h"
#include <QComboBox>
#include <QLineEdit>

class AddClasse : public MyAdd
{
    Q_OBJECT
private:
    QLineEdit *ledtNom;
    QLineEdit *ledtFiliere;
    QComboBox *cmbEntree;
    QComboBox *cmbSortie;

protected slots:
    virtual void envoyer();

public:
    explicit AddClasse(COAC *, Database *);
};

#endif // ADDCLASSE_H
