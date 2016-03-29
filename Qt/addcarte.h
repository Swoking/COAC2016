#ifndef ADDCARTE_H
#define ADDCARTE_H

#include "ui_addcarte.h"

class AddCarte : public QDialog, private Ui::AddCarte
{
    Q_OBJECT

public:
    explicit AddCarte(QWidget *parent = 0);
};

#endif // ADDCARTE_H
