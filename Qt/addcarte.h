#ifndef ADDCARTE_H
#define ADDCARTE_H

#include "ui_addcarte.h"
#include "coac.h"

class COAC;

class AddCarte : public QDialog, private Ui::AddCarte
{
    Q_OBJECT

public:
    COAC *fenetre;
    explicit AddCarte(COAC* fen, QWidget *parent = 0);
};

#endif // ADDCARTE_H
