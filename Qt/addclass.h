#ifndef ADDCLASS_H
#define ADDCLASS_H

#include "ui_addclass.h"
#include "coac.h"

class COAC;

class AddClass : public QDialog, private Ui::AddClass
{
    Q_OBJECT

public:
    COAC *fenetre;
    explicit AddClass(COAC* fen, QWidget *parent = 0);

public slots:
    void onAcceptedAddClasse();
};

#endif // ADDCLASS_H
